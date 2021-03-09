<?php

  /*
   * XML Made Simple Feed class
   *
   * Author: Jean-Christophe Cuvelier (jcc@morris-chapman.com)
   * Copyright: Jean-Christophe Cuvelier - Morris & Chapman Belgium
   *
   * Created: 20091021
   */

class MCFeed
{
	 var $id;
	 var $title;
     var $description;
	 var $feed_url;

	 var $contents;

	 var $config;

	 const DB_NAME  = 'module_xmlmadesimple_feed';

	 public function __toString()	 {
	   return $this->getTitle();
	 }

	 public function setId($value)	 {
	   $this->id = $value;
	 }

	 public function getId()	 {
	   return $this->id;
	 }

	 public function getTitle()	 {
	   return $this->title;
	 }

	 public function setTitle($title)	 {
	   $this->title = $title;
	 }

     public function getFeedDescription() {
        return $this->description;
    }

    public function setFeedDescription($description) {
        $this->description = $description;
    }

	 public function getFeedUrl()	 {
	   return trim($this->feed_url);
	 }

	 public function setFeedUrl($value)	 {
	   $this->feed_url = $value;
	 }

	// Feed loading function

	 public function getFeed()	 {
	 	if ($module = cms_utils::get_module('XMLMadeSimple2'))
	 	{
	 		$cache = $module->getPreference('cache');
	 	}
	 	else
	 	{
	 		$cache = 900;
	 	}

	 	if ($this->checkCache($cache))
    {
      $this->getFeedByCache();
    }
    else
    {
      $this->getFeedByUrl();
    }

    return simplexml_load_string($this->contents, 'SimpleXMLElement', LIBXML_NOCDATA);
	 }

	 protected function getFeedByUrl()	 {
	  $context_array =  array();
	  $module = cms_utils::get_module('XMLMadeSimple2');
    if($proxy_url = $module->GetPreference('proxy_url', false))
    {
      $context_array['html']['proxy'] = $proxy_url;
      $context_array['html']['request_fulluri'] = true;
      if($proxy_login = $module->GetPreference('proxy_login', false))
      {
        $proxy_password = $module->GetPreference('proxy_password',false);
        $context_array['html']['header'] = 'Proxy-Authorization: Basic ' . base64_encode($proxy_login . ':' . $proxy_password);
      }

    }
    $context =  stream_context_create($context_array);
	 	$this->contents = file_get_contents($this->getFeedUrl(), false, $context);
	 	$this->setFeedCache();
	 }

	 protected function getFeedByCache()	 {
	 	$this->contents = file_get_contents($this->getCachePath());
	 }

	 protected function setFeedCache()	 {
	    file_put_contents($this->getCachePath(), $this->contents);
	 }

	 protected function checkCache($lenght)	 {
	    $file = $this->getCachePath();

	 	 if (!is_file($file) || filemtime($file) < (time()-$lenght))
	 	 {
	 	    // Cache too old
	 	    return false;
	 	 }
	 	 else
	 	 {
	 	    return true;
	 	 }
	 }

	 protected function getCachePath()	 {
	   $config = cms_utils::get_config();
	   return $config['previews_path'] . '/xmlmadesimple_cache_' . $this->getId() . '.tmp';
	 }

	 public static function compareEntryDates($a, $b)	 {
	    return strcmp($a['updated'], $b['updated']);
	 }

	// DATABASE Aspect

  public function Populate($row)  {
      if (isset($row['id']) )
      {
        $this->id = $row['id'];
      }

      if (isset($row['title']))
      {
        $this->title = $row['title'];
      }

      if (isset($row['feed_url']))
      {
        $this->feed_url = $row['feed_url'];
      }

      if (isset($row['feed_description'])) {
          $this->description = $row['feed_description'];
      }
  }

	public function PopulateFromDb($row)	{
	  $this->Populate($row);
	}

  public function save()  {
    // Upgrade or Insert ?
    if ($this->id != null) {
        $this->update();
        // if we do changes delete cached file
        if (file_exists($this->getCachePath())) {
            unlink($this->getCachePath());
        }
    } else {
        $this->insert();
    }
  }

  protected function update()  {

    $db = cms_utils::get_db();


      $query = 'UPDATE  ' . cms_db_prefix() .  self::DB_NAME . '

      SET ';

      $query .= 'title = ?, feed_url = ?, feed_description = ?';

      $query .= '

      WHERE

      id = ?  ';


      $result = $db->Execute($query,
          array(
              $this->getTitle(),
              $this->getFeedUrl(),
              $this->getFeedDescription(),
              $this->getId()
          )
        );

        //FIXME: Test the $db status;

        return true;
  }

  protected function insert()  {

    $db = cms_utils::get_db();

    $this->setId($db->GenID(cms_db_prefix() .  self::DB_NAME .'_seq' ));

    $query = 'INSERT INTO ' . cms_db_prefix() .  self::DB_NAME .  '

      SET  id = ?,  ';

      $query .= 'title = ?, feed_url = ?, feed_description = ?';


       $db->Execute($query,
          array(
            $this->getId(),
            $this->getTitle(),
            $this->getFeedUrl(),
            $this->getFeedDescription(),
          )
        );

        return true;
  }

  public static function retrieveByPk($id)  {
    return self::doSelectOne(array('where' => array('id' => $id)));
  }

  public static function doSelectOne($params = array()) {
    $items = self::doSelect($params);
    if ($items)
    {
      return $items[0];
    }
    else
    {
      return null;
    }
  }

  public static function doSelect($params = array())  {

    $db = cms_utils::get_db();

    $query = 'SELECT * FROM ' . cms_db_prefix() . self::DB_NAME;

    $values = array();
    $fields = array();

    if (isset($params['where']))
     {
       foreach ($params['where'] as $field => $value)
       {
         $fields[] = $field . ' =  ?';
         $values[] = $value;
       }
     }

     if (isset($params['where_in']))
     {
       foreach ($params['where_in'] as  $field => $value)
       {
          $fields[] =  $field . ' IN (' . "'" . implode("','", $value) . "'" . ')';
       }
     }

     if (count($fields))
     {
        $query .= ' WHERE ' . implode(' AND ', $fields);
     }


    $dbresult = $db->Execute($query, $values);

    $items = array();
   if ($dbresult && $dbresult->RecordCount() > 0)
    {
      while ($dbresult && $row = $dbresult->FetchRow())
      {
        $item = new self();
        $item->PopulateFromDb($row);
        $items[] = $item;
      }
    }

    return  $items;
  }

  public function delete()  {

    $db = cms_utils::get_db();
    $query = 'DELETE FROM '. cms_db_prefix() . self::DB_NAME;
    $query .= ' WHERE id = ?';
    $db->Execute($query, array($this->id));
  }

  public static function deleteById($id)  {

     $feed = self::retrieveByPk($id);
     $feed->delete();
  }

}