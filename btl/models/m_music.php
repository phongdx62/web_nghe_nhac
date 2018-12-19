<?php  
	include('../public/library/database.php');
	class music extends database
	{
		protected $id;
		protected $song;
		protected $singer;
		protected $musician;
		protected $country;
		protected $style;	
		protected $new;
		protected $best;
		protected $topten;
		protected $img;
		protected $mp3;

		public function __construct()
		{
			$this->connect();
		}

		public function set_song($Song)
		{
			$this->song = $Song;
		}

		public function get_song()
		{
			return $this->song;
		}

		public function set_singer($Singer)
		{
			$this->singer = $Singer;
		}

		public function get_singer()
		{
			return $this->singer;
		}

		public function set_musician($Musician)
		{
			$this->musician = $Musician;
		}

		public function get_musician()
		{
			return $this->musician;
		}

		public function set_country($Country)
		{
			$this->country = $Country;
		}

		public function get_country()
		{
			return $this->country;
		}

		public function set_style($Style)
		{
			$this->style = $Style;
		}

		public function get_style()
		{
			return $this->style;
		}

		public function set_new($New)
		{
			$this->new = $New;
		}

		public function get_new()
		{
			return $this->new;
		}

		public function set_best($Best)
		{
			$this->best = $Best;
		}

		public function get_best()
		{
			return $this->best;
		}

		public function set_topten($Topten)
		{
			$this->Topten = $Topten;
		}

		public function get_topten()
		{
			return $this->topten;
		}

		public function set_img($Img)
		{
			$this->img = $Img;
		}

		public function get_img()
		{
			return $this->img;
		}

		public function set_mp3($Mp3)
		{
			$this->mp3 = $Mp3;
		}

		public function get_mp3()
		{
			return $this->mp3;
		}

		public function m_list_music()
		{
			$sql = "SELECT song, singer, musician, country, style, new, best, topten FROM music";
			$this->query($sql);
			$stt=1;
			while($row = $this->fetch_assoc())
			{
				require("templates/show_music.php");
				$stt++;
			}
		}

		public function m_del_music($id)
		{
			$sql = "DELETE FROM music WHERE id = $id";
			$this->query($sql);
		}

		public function m_search_music($key)
		{
			$sql = "SELECT id, song, singer, musician, country, style, new, best, topten FROM music 
					WHERE song LIKE '%$key%' OR singer LIKE '%$key%' OR musician LIKE '%$key%' OR country LIKE '%$key%' OR style LIKE '%$key%' ";
			$this->query($sql);
			$num = $this->num_rows();
			if ($num > 0 && $key != "") 
            {
                echo "<p style='color:#0000FF;'>$num kết quả trả về với từ khóa <b>$key</b></p>";
                echo '<table border="1" cellspacing="0" cellpadding="10">'; 
                require("templates/table_music.php");
                
                while ($row = $this->fetch_assoc()) 
                {
                    require("templates/show_music.php");         
                }                   
            } 
            else 
            {
                echo"<p style='color:red;'>* Không tìm thấy kết quả!</p>";
            }
		}

		public function m_add_music($song, $singer, $musician, $country, $style, $new, $best, $topten)
		{
			$sql = "SELECT id FROM music WHERE song = '$song'";
			$this->query($sql);

			$num = $this->num_rows();
			if($num>0)
			{
				return 'fail';
			}
			else
			{
				$sql = "INSERT INTO music(song,
										  singer,
										  musician,
										  country,
										  style,
										  new,
										  best,
										  topten)	VALUES	
										  ('$song',
										   '$singer',
										   '$musician',
										   '$country',
										   '$style',
										   '$new',
										   '$best',
										   '$topten')";
				$this->query($sql);
			}
		}

		public function m_edit_music($id, $song, $singer, $musician, $country, $style, $new, $best, $topten)
		{
			$sql = "UPDATE music SET song = '$song', 
									 singer = '$singer', 
									 musician = '$musician', 
									 country = '$country', 
									 style = '$style', 
									 new = '$new', 
									 best = '$best', 
									 topten = '$topten' 
								 WHERE id = $id";
			$this->query($sql);
		}

		public function m_get_music($id)
		{
			$sql = "SELECT id, song, singer, musician, country, style, new, best, topten 
					FROM music WHERE id = $id";
			$this->query($sql);
			$row = $this->fetch_assoc();
			return $row;
		}		
	}
?>