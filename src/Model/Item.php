<?php
/**
 *	...
 *
 *	Copyright (c) 2012-2015 Christian Würker / {@link https://ceusmedia.de/ Ceus Media}
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *	@category		Library
 *	@package		CeusMedia_RSS
 *	@author			Christian Würker <christian.wuerker@ceusmedia.de>
 *	@copyright		2012-2020 {@link https://ceusmedia.de/ Ceus Media}
 *	@license		http://www.gnu.org/licenses/gpl-3.0.txt GPL 3
 *	@link			https://github.com/CeusMedia/RSS
 */
namespace CeusMedia\RSS\Model;

/**
 *	...
 *
 *	@category		Library
 *	@package		CeusMedia_RSS
 *	@author			Christian Würker <christian.wuerker@ceusmedia.de>
 *	@copyright		2012-2020 {@link https://ceusmedia.de/ Ceus Media}
 *	@license		http://www.gnu.org/licenses/gpl-3.0.txt GPL 3
 *	@link			https://github.com/CeusMedia/RSS
 */
class Item
{
	protected $author		= array();
	protected $category		= NULL;
	protected $content		= NULL;
	protected $date			= NULL;
	protected $link			= NULL;
	protected $guid			= array();
	protected $source		= array();
	protected $title		= NULL;

	public function getAuthor()
	{
		return $this->author;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getId()
	{
		return $this->guid;
	}

	public function getLink()
	{
		return $this->link;
	}

	public function getSource()
	{
		return $this->source;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setAuthor( $email, $name = NULL ): self
	{
		$this->author	= array( $email, $name );
		return $this;
	}

	public function setCategory( $category ): self
	{
		$this->category	= $category;
		return $this;
	}

	public function setContent( $content ): self
	{
		$this->content	= $content;
		return $this;
	}

	public function setDate( $date ): self
	{
		$this->date		= $date;
		return $this;
	}

	public function setId( $uri, $isPermaLink = FALSE ): self
	{
		$this->guid	= array( $uri, $isPermaLink );
		return $this;
	}

	public function setLink( $link ): self
	{
		$this->link		= $link;
		return $this;
	}

	public function setSource( $uri, $label ): self
	{
		$this->source	= array( $uri, $label );
		return $this;
	}

	public function setTitle( $title ): self
	{
		$this->title	= $title;
		return $this;
	}
}
