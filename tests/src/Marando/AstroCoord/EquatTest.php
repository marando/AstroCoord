<?php

namespace Marando\AstroCoord;

use \Marando\AstroDate\AstroDate;
use \Marando\AstroDate\Epoch;
use \Marando\Units\Angle;
use \Marando\Units\Distance;
use \Marando\Units\Pressure;
use \Marando\Units\Temperature;
use \Marando\Units\Time;
use \PHPUnit_Framework_TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-05 at 00:10:16.
 */
class EquatTest extends PHPUnit_Framework_TestCase {

  /**
   * @covers Marando\AstroCoord\Equat::apparent
   */
  public function testApparentGeocentr() {
    // Earth -> Venus @ 2015-Nov-08 23:20:34.000 UT
    $dt = AstroDate::jd(2457335.472615740);
    $x  = Distance::au(-7.956853147170494E-01);
    $y  = Distance::au(-8.073016903017960E-03);
    $z  = Distance::au(1.392567642390632E-02);
    $c  = new Cartesian(Frame::ICRF(), $dt->toEpoch(), $x, $y, $z);


    $apparent = $c->toEquat()->apparent();

    $prec = Angle::arcsec(3)->deg;
    $this->assertEquals(180.78098, $apparent->ra->toAngle()->deg, 'ra', $prec);
    $this->assertEquals(0.91583, $apparent->dec->deg, 'dec', $prec);
  }

  /**
   * @covers Marando\AstroCoord\Equat::apparent
   */
  public function testApparentTopo() {
    // Earth -> Venus @ 2015-Nov-08 23:20:34.000 UT
    $dt           = AstroDate::jd(2457335.472615740);
    $x            = Distance::au(-7.956853147170494E-01);
    $y            = Distance::au(-8.073016903017960E-03);
    $z            = Distance::au(1.392567642390632E-02);
    $c            = new Cartesian(Frame::ICRF(), $dt->toEpoch(), $x, $y, $z);
    $equat        = $c->toEquat();
    $equat->obsrv = Geo::deg(27.9494000, -82.4569);


    $apparent = $equat->apparent();

    $prec = 0.3;
    $this->assertEquals(180.77899, $apparent->ra->toAngle()->deg, 'ra', $prec);
    $this->assertEquals(0.91437, $apparent->dec->deg, 'dec', $prec);
  }

  /**
   * @covers Marando\AstroCoord\Equat::toHoriz
   */
  public function testToHoriz() {
    $epoch       = AstroDate::parse('2015-Nov-08 23:20:34.000')->toEpoch();
    $ra          = Angle::deg(180.58211)->toTime();
    $dec         = Angle::deg(1.00232);
    $astr        = new Equat(Frame::ICRF(), $epoch, $ra, $dec, Distance::m(0));
    $astr->obsrv = Geo::deg(27.9494000, -82.4569);


    $horiz = $astr->toHoriz();

    $prec = Angle::arcsec(9)->deg;
    $this->assertEquals(-37.8887, $horiz->alt->deg, 'alt', $prec);
    $this->assertEquals(295.8340, $horiz->az->deg, 'az', $prec);
  }

  public function testToEclip() {
    // Earth -> Venus @ 2015-Nov-08 23:20:34.000 UT
    $dt    = AstroDate::jd(2457335.472615740);
    $x     = Distance::au(-7.956853147170494E-01);
    $y     = Distance::au(-8.073016903017960E-03);
    $z     = Distance::au(1.392567642390632E-02);
    $c     = new Cartesian(Frame::ICRF(), $dt->toEpoch(), $x, $y, $z);
    $equat = $c->toEquat();


    $eclip = $equat->toEclip();

    $prec = Angle::arcmin(13)->deg;
    $this->assertEquals(180.3510658, $eclip->lon->deg, 'λ', $prec);
    $this->assertEquals(1.1487465, $eclip->lat->deg, 'β', $prec);
  }

}
