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
namespace CeusMedia\RSS;

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
class Combiner
{
	protected $channels	= array();

	public function add( $rss ): self
	{
		$this->channels[]	= Parser::parse( $rss );
		return $this;
	}

	public function addChannel( Model\Channel $channel ): self
	{
		$this->channels[]	= $channel;
		return $this;
	}

	public function addUrl( $url ): self
	{
		$this->add( \Net_Reader::readUrl( $url ) );
		return $this;
	}

	public function combine( $limit = 0 ): array
	{
		$list	= array();
		foreach( $this->channels as $channel ){
			foreach( $channel->getItems() as $item ){
				$timestamp	= 0;
				if( $item->getDate() )
					$timestamp	= $item->getDate();
				if( !isset( $list[$timestamp] ) )
					$list[$timestamp]	= array();
				$list[$timestamp][]	= $item;
			}
		}
		krsort( $list );
		$items	= array();
		foreach( $list as $timestamp => $entries ){
			foreach( $entries as $entry )
				$items[]	= $entry;
		}
		if( $limit > 0 )
			$items	= array_slice( $items, 0, $limit );
		return $items;
	}

	public function render( $channel, $limit = 0 ): string
	{
		foreach( $this->combine( $limit ) as $item )
			$channel->addItem( $item );
		return Renderer::render( $channel );
	}
}
