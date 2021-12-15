<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Upload
 * 
 * @ORM\Table(name="uploads")
 * @ORM\Entity(repositoryClass="App\Repository\UploadRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Upload
{
	
    /**
     * Constructor
     */
    public function __construct()
    {
		$this->uploadAt = new \DateTime();
	}

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name = "";

	    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="uploadAt", type="datetime")
     */
    private $uploadAt;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
	private $directoryUpload;

    /**
     * @Vich\UploadableField(mapping="fileuploads", fileNameProperty="link")
     * @Assert\File(maxSize = "10M")
     * 
     * @var File
     */
    private $file;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
	
	/**
     * Set link
     *
     * @param string $link
     *
     * @return Attachment
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set uploadAt
     *
     * @param \DateTime $uploadAt
     *
     * @return Attachment
     */
    public function setUploadAt($uploadAt)
    {
        $this->uploadAt = $uploadAt;

        return $this;
    }

    /**
     * Get uploadAt
     *
     * @return \DateTime
     */
    public function getUploadAt()
    {
        return $this->uploadAt;
    }
    
    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return File
     */
    public function setFile(File $file = null) {
        $this->file = $file;
        if($file){
            $this->uploadAt = new \DateTime();
        }
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile() {
        return $this->file;
    }

	public function setDirectoryUpload($directoryUpload){
		$this->directoryUpload=$directoryUpload;
	}

	public function getDirectoryUpload(){
		return $this->directoryUpload;
	}
	
	public function getLinkComplete()
	{
		if(!is_null($this->getLink())){
			if($this->getDirectoryUpload() != ''){
				return 'uploads/'.$this->getDirectoryUpload().'/'.$this->getLink();
			}else{
				return 'uploads/'.$this->getLink();
			}
		}
		return '';
	}
        
    
}
