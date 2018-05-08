<?php

class ResizeImage
{
	protected $width;
    protected $height;
    protected $image;

	function __construct($file)
	{
		echo $file;
		if (null !== $file) 
		{
			if (is_file($file)) 
			{
                $this->setImageFile($file);
			} 
			else 
			{
               echo "error data";
            }
        }
	}

	public function setImageFile($file)
    {
		// echo "here";
		if (!(is_readable($file) && is_file($file))) 
		{
			// echo "here";
            throw new InvalidArgumentException("Image file $file is not readable");
        }
		if (is_resource($this->image)) 
		{
            imagedestroy($this->image);
        }
		list ($this->width, $this->height, $type) = getimagesize($file);
		echo $type;
        switch ($type) {
            case IMAGETYPE_GIF  :
                $this->image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG :
                $this->image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG  :
                $this->image = imagecreatefrompng($file);
                break;
            default             :
                throw new InvalidArgumentException("Image type $type not supported");
		}
		echo $this->image;
        return $this;
    }

	public function resample($width, $height, $constrainProportions = true)
    {
		if (!is_resource($this->image)) 
		{
            throw new RuntimeException('No image set');
        }
		if ($constrainProportions) 
		{
			if ($this->height >= $this->width) 
			{
                $width  = round($height / $this->height * $this->width);
			} 
			else 
			{
                $height = round($width / $this->width * $this->height);
            }
        }
        $temp = imagecreatetruecolor($width, $height);
        imagecopyresampled($temp, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
        return $this->_replace($temp);
	}
	
	protected function _replace($res)
    {
        if (!is_resource($res)) {
            throw new UnexpectedValueException('Invalid resource');
        }
        if (is_resource($this->image)) {
            imagedestroy($this->image);
        }
        $this->image = $res;
        $this->width = imagesx($res);
        $this->height = imagesy($res);
        return $this;
	}
	
	public function save($fileName, $type = IMAGETYPE_JPEG)
    {
		$dir = dirname($fileName);
		if (!is_dir($dir)) 
		{
			if (!mkdir($dir, 0755, true)) 
			{
                throw new RuntimeException('Error creating directory ' . $dir);
            }
        }
        
		try 
		{
			switch ($type) 
			{
                case IMAGETYPE_GIF  :
					if (!imagegif($this->image, $fileName)) 
					{
                        throw new RuntimeException;
                    }
                    break;
                case IMAGETYPE_PNG  :
					if (!imagepng($this->image, $fileName)) 
					{
                        throw new RuntimeException;
                    }
                    break;
                case IMAGETYPE_JPEG :
                default             :
					if (!imagejpeg($this->image, $fileName, 95)) 
					{
                        throw new RuntimeException;
                    }
            }
		} 
		catch (Exception $ex) 
		{
            throw new RuntimeException('Error saving image file to ' . $fileName);
        }
    }
}
?>