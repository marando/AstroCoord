<?php

namespace Marando\AstroCoord;

use \Marando\AstroDate\AstroDate;
use \Marando\Units\Distance;
use \Marando\Units\Velocity;
use \PHPUnit_Framework_TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-04 at 23:32:31.
 */
class CartesianTest extends PHPUnit_Framework_TestCase {

  /**
   * @covers Marando\AstroCoord\Cartesian::add

   */
  public function testAdd() {
    // Frame & epoch
    $frame = Frame::ICRF();
    $epoch = AstroDate::parse('2015-Mar-20 00:00:00')->toEpoch();

    // Position / velocity
    $x  = Distance::au(+1.18);
    $y  = Distance::au(-3.65);
    $z  = Distance::au(-2.12);
    $vx = Velocity::aud(2.05);
    $vy = Velocity::aud(2.82);
    $vz = Velocity::aud(1.14);
    $a  = new Cartesian($frame, $epoch, $x, $y, $z, $vx, $vy, $vz);

    $x  = Distance::au(+9.32);
    $y  = Distance::au(-5.25);
    $z  = Distance::au(-6.89);
    $vx = Velocity::aud(5.33);
    $vy = Velocity::aud(2.09);
    $vz = Velocity::aud(0.69);
    $b  = new Cartesian($frame, $epoch, $x, $y, $z, $vx, $vy, $vz);

    $c = $a->add($b);
    $this->assertEquals(10.5, $c->x->au);
    $this->assertEquals(-8.9, $c->y->au);
    $this->assertEquals(-9.01, $c->z->au);
    $this->assertEquals(7.38, $c->vx->aud);
    $this->assertEquals(4.91, $c->vy->aud);
    $this->assertEquals(1.83, $c->vz->aud);

    // // //
    // Position / velocity
    $x = Distance::au(+1.18);
    $y = Distance::au(-3.65);
    $z = Distance::au(-2.12);
    $a = new Cartesian($frame, $epoch, $x, $y, $z);

    $x = Distance::au(+9.32);
    $y = Distance::au(-5.25);
    $z = Distance::au(-6.89);
    $b = new Cartesian($frame, $epoch, $x, $y, $z);

    $c = $a->add($b);
    $this->assertEquals(10.5, $c->x->au);
    $this->assertEquals(-8.9, $c->y->au);
    $this->assertEquals(-9.01, $c->z->au);

    $s = (string)$c;
  }

  /**
   * @covers Marando\AstroCoord\Cartesian::subtract
   */
  public function testSubtract() {
    // Frame & epoch
    $frame = Frame::ICRF();
    $epoch = AstroDate::parse('2015-Mar-20 00:00:00')->toEpoch();

    // Position / velocity
    $x  = Distance::au(+1.18);
    $y  = Distance::au(-3.65);
    $z  = Distance::au(-2.12);
    $vx = Velocity::aud(2.05);
    $vy = Velocity::aud(2.82);
    $vz = Velocity::aud(1.14);
    $a  = new Cartesian($frame, $epoch, $x, $y, $z, $vx, $vy, $vz);

    $x  = Distance::au(+9.32);
    $y  = Distance::au(-5.25);
    $z  = Distance::au(-6.89);
    $vx = Velocity::aud(5.33);
    $vy = Velocity::aud(2.09);
    $vz = Velocity::aud(0.69);
    $b  = new Cartesian($frame, $epoch, $x, $y, $z, $vx, $vy, $vz);

    $c = $a->subtract($b);
    $this->assertEquals(-8.14, $c->x->au);
    $this->assertEquals(1.6, $c->y->au);
    $this->assertEquals(4.77, $c->z->au);
    $this->assertEquals(-3.28, $c->vx->aud);
    $this->assertEquals(0.73, $c->vy->aud);
    $this->assertEquals(0.45, $c->vz->aud);
  }

  /**
   * @covers Marando\AstroCoord\Cartesian::toEquat
   */
  public function testToEquat() {
    $frame = Frame::ICRF();
    $epoch = AstroDate::parse('2015-Mar-20 00:00:00')->toEpoch();

    // Position
    $x   = Distance::pc(-0.472);
    $y   = Distance::pc(-0.361);
    $z   = Distance::pc(-1.151);
    $xyz = new Cartesian($frame, $epoch, $x, $y, $z);

    $eq = $xyz->toEquat();
    $this->assertEquals(14.4966, $eq->ra->hours, 'ra', 1e-2);
    $this->assertEquals(-62.681, $eq->dec->deg, 'dec', 1e-1);
    $this->assertEquals(1.29, $eq->dist->pc, 'dist', 1e-2);
  }

  public function testCreateWithAstroDate() {
    $x = Distance::au(+9.32);
    $y = Distance::au(-5.25);
    $z = Distance::au(-6.89);
    $c = new Cartesian(Frame::ICRF(), AstroDate::now(), $x, $y, $z);
  }

}
