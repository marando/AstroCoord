<?php

namespace Marando\AstroCoord;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-18 at 15:26:13.
 */
class GeoTest extends \PHPUnit_Framework_TestCase {

  /**
   * @covers Marando\AstroCoord\Geo::deg
   */
  public function testDeg() {
    $tests = [
        [27, -82],
        [-27, 82],
    ];

    foreach ($tests as $t) {
      $lat = $t[0];
      $lon = $t[1];

      $geo = Geo::deg($lat, $lon);
      $this->assertEquals($lat, $geo->lat->deg);
      $this->assertEquals($lon, $geo->lon->deg);
    }
  }

  /**
   * @covers Marando\AstroCoord\Geo::rad
   */
  public function testRad() {
    $tests = [
        [1.456, -0.0234],
        [-1.456, 0.0234],
    ];

    foreach ($tests as $t) {
      $lat = $t[0];
      $lon = $t[1];

      $geo = Geo::rad($lat, $lon);
      $this->assertEquals($lat, $geo->lat->rad);
      $this->assertEquals($lon, $geo->lon->rad);
    }
  }

  /**
   * @covers Marando\AstroCoord\Geo::isN
   */
  public function testIsN() {
    for ($lat = 0; $lat < 90; $lat ++)
      $this->assertTrue(Geo::deg($lat, 0)->isN(), "0 < Lat < 90 ($lat)");

    for ($lat = -90; $lat < 0; $lat ++)
      $this->assertFalse(Geo::deg($lat, 0)->isN(), "-90 < Lat < 0 ($lat)");
  }

  /**
   * @covers Marando\AstroCoord\Geo::isW
   */
  public function testIsW() {
    for ($lon = 1; $lon < 180; $lon ++)
      $this->assertFalse(Geo::deg(0, $lon)->isW(), "1 < Lon < 180 ({$lon})");

    for ($lon = -180; $lon <= 0; $lon ++)
      $this->assertTrue(Geo::deg(0, $lon)->isW(), "-180 < Lon <= 1 ({$lon})");
  }

  /**
   * @covers Marando\AstroCoord\Geo::isS
   * @todo   Implement testIsS().
   */
  public function testIsS() {
    for ($lat = 1; $lat < 90; $lat ++)
      $this->assertFalse(Geo::deg($lat, 0)->isS(), "0 < Lat < 90 ($lat)");

    for ($lat = -90; $lat <= 0; $lat ++)
      $this->assertTrue(Geo::deg($lat, 0)->isS(), "-90 < Lat < 0 ($lat)");
  }

  /**
   * @covers Marando\AstroCoord\Geo::isE
   */
  public function testIsE() {
    for ($lon = 0; $lon < 180; $lon ++)
      $this->assertTrue(Geo::deg(0, $lon)->isE(), "1 < Lon < 180 ({$lon})");

    for ($lon = -180; $lon < 0; $lon ++)
      $this->assertFalse(Geo::deg(0, $lon)->isE(), "-180 < Lon < 0 ({$lon})");
  }

}
