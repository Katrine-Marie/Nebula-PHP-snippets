<?php
	Class RSS_feed {
		
		protected $site_title, $site_desc, $site_link;
		
		public function __construct($objConnection){
			$this->objConnection = $objConnection;
		}
		
		public function getTitle(){
			return $this->site_title;
		}
		public function getDescription(){
			return $this->site_desc;
		}
		public function getLink(){
			return $this->site_link;
		}
		
		public function setTitle($title){
			$this->site_title = $title;
		}
		public function setDescription($desc){
			$this->site_desc = $desc;
		}
		public function setLink($link){
			$this->site_link = $link;
		}
		
		// This function converts contents of db-table to array and returns the array
		protected function make_array(){
			$table = 'rss_news';
			
			$query = "SELECT * FROM {$table}";
			$objResult = $this->objConnection->query($query);
			
			$array = array();
			$i = 0;
			
			while($row = $objResult->fetch_object()){
				$array[$i]['title'] = $row->title;
				$array[$i]['description'] = $row->content;
				$array[$i]['date'] = $row->created;
				
				$i++;
			}
			return $array;
		}

		// This function creates RSS 2.0 feed based on array created in previous function
		public function make_feed(){
			
			$xml = new SimpleXMLElement('<rss/>');
			$xml->addAttribute('version', '2.0');

			$channel = $xml->addChild('channel');

			$channel->addChild('title', $this->site_title);
			$channel->addChild('description', $this->site_desc);
			$channel->addChild('link', $this->site_link);
			
			$items = $this->make_array();
		
			foreach($items as $entry){
				$item = $channel->addChild('item');
				$item->addChild('title', $entry['title']);
				$item->addChild('description', $entry['description']);
				$item->addChild('pubDate', $entry['date']);
			}

			header('Content-type: text/xml');
			return print($xml->asXML("feed.xml"));
		}
		
	}
