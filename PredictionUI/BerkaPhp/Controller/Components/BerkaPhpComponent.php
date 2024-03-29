<?php
	namespace berkaPhp\controller\component;

	interface Component {
		function setName($value);
		function setAuthor($value);
		function setDescription($value);
	}

    abstract class BerkaPhpComponent implements Component
	{
		protected $db;
		private $name, $author, $description;

		function __construct()
		{
			$this->db = null;
		}

		public function getName() {
			return $this->name;
		}

		public function getAuthor() {
			return $this->author;
		}

		public function getDescription() {
			return $this->description;
		}

		public function setName($value) {
			$this->name = $value;
		}

		public function setAuthor($value) {
			$this->author = $value;
		}

		public function setDescription($value) {
			$this->description = $value;
		}

	}

?>