<?php
	class Product{		

		private $id;
		private $name;
		private $price;
		private $rating;
		private $description;
		private $thumbnail;
		private $pictures;
		private $category;
				
		function __construct($id, $name, $price, $rating, $description, $thumbnail, $pictures, $category){
			$this->setId($id);
			$this->setName($name);
			$this->setPrice($price);
			$this->setRating($rating);
			$this->setDescription($description);
			$this->setThumbnail($thumbnail);
			$this->setPictures($pictures);
			$this->setCategory($category);
			}		
		
		public function getId(){ return $this->id; }
		public function setId($id){ $this->id = $id; }

		public function getName(){ return $this->name; }
		public function setName($name){ $this->name = $name; }

		public function getPrice(){ return $this->price; }
		public function setPrice($price){ $this->price = $price; }

		public function getRating(){ return $this->rating; }
		public function setRating($rating){ $this->rating = $rating; }

		public function getDescription(){ return $this->description; }
		public function setDescription($description){ $this->description = $description; }

		public function getThumbnail(){ return $this->thumbnail; }
		public function setThumbnail($thumbnail){ $this->thumbnail = $thumbnail; }

		public function getPictures(){ return $this->pictures; }
		public function setPictures($pictures){ $this->pictures = $pictures; }

		public function getCategory(){ return $this->category; }
		public function setCategory($category){ $this->category = $category; }

		public function getProduct(){
		
			$product = new \stdClass();
			$product->id = $this->id;
			$product->name = $this->name;
			$product->price = $this->price;
			$product->rating = $this->rating;
			$product->description = $this->description;
			$product->thumbnail = $this->thumbnail;
			$product->pictures = $this->pictures;
			$product->category = $this->category;
			$productJson = json_encode($product);
			return $product;
			// return $productJson;
		}

	}
