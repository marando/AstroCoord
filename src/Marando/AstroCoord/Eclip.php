<?php

/*
 * Copyright (C) 2015 ashley
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace Marando\AstroCoord;

use \Marando\Units\Angle;
use \Marando\Units\Distance;

/**
 * Represents ecliptic coordinates
 *
 * @property Angle    $lon  Ecliptic longitude
 * @property Angle    $lat  Ecliptic latitude
 * @property Distance $dist Observer to target distance
 */
class Eclip {

  use Traits\CopyTrait;

  //----------------------------------------------------------------------------
  // Constructors
  //----------------------------------------------------------------------------

  /**
   * Creates a new Ecliptic coordinate
   *
   * @param Angle    $lon  Ecliptic longitude
   * @param Angle    $lat  Ecliptic latitude
   * @param Distance $dist Observer to target distance
   */
  public function __construct(Angle $lon, Angle $lat, Distance $dist = null) {
    $this->setPosition($lon, $lat);
    $this->setDistance($dist);
  }

  //----------------------------------------------------------------------------
  // Properties
  //----------------------------------------------------------------------------

  /**
   * Ecliptic longitude
   * @var Angle
   */
  protected $lon;

  /**
   * Ecliptic latitude
   * @var Angle
   */
  protected $lat;

  /**
   * Observer to target distance
   * @var Distance
   */
  protected $dist;

  public function __get($name) {
    switch ($name) {
      case 'lon':
      case 'lat':
      case 'dist':
        return $this->{$name};
    }
  }

  public function __set($name, $value) {
    switch ($name) {
      case 'lon':
        return $this->setPosition($value, $this->lat);

      case 'lat':
        return $this->setPosition($this->lon, $value);

      case 'dist':
        return $this->setDistance($value);
    }
  }

  //----------------------------------------------------------------------------
  // Functions
  //----------------------------------------------------------------------------

  /**
   * Sets the altitude and azimuth of this instance
   *
   * @param  Angle  $lon Ecliptic longitude
   * @param  Angle  $lat Ecliptic latitude
   * @return static
   */
  public function setPosition(Angle $lon, Angle $lat) {
    $this->lon = $lon;
    $this->lat = $lat;

    return $this;
  }

  /**
   * Sets the target to observer distance
   *
   * @param  Distance $dist
   * @return static
   */
  public function setDistance(Distance $dist) {
    $this->dist = $dist;

    return $this;
  }

  // // // Overrides

  /**
   * Represents this instance as a string
   * @return string
   */
  public function __toString() {
    // Longitude
    $λd = sprintf('%03.0f', $this->lon->d);
    $λm = sprintf('%02d', $this->lon->m);
    $λs = sprintf('%02d', $this->lon->s);
    $λμ = str_replace('0.', '', round($this->lon->s - intval($this->lon->s), 3));
    $λμ = str_pad($λμ, 3, '0', STR_PAD_RIGHT);

    // Latitude
    $βd = sprintf('%+03.0f', $this->lat->d);
    $βm = sprintf('%02d', $this->lat->m);
    $βs = sprintf('%02d', $this->lat->s);
    $βμ = str_replace('0.', '', round($this->lat->s - intval($this->lat->s), 3));
    $βμ = str_pad($βμ, 3, '0', STR_PAD_RIGHT);

    // Format string
    $λ = "{$λd}°{$λm}'{$λs}\".{$λμ}";
    $β = "{$βd}°{$βm}'{$βs}\".{$βμ}";
    return "λ {$λ}, β {$β}, {$this->dist}";
  }

}
