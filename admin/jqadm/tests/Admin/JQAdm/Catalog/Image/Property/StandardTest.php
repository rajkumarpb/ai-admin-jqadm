<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2018
 */


namespace Aimeos\Admin\JQAdm\Catalog\Media\Property;


class StandardTest extends \PHPUnit\Framework\TestCase
{
	private $context;
	private $object;
	private $view;


	protected function setUp()
	{
		$this->view = \TestHelperJqadm::getView();
		$this->context = \TestHelperJqadm::getContext();

		$this->object = new \Aimeos\Admin\JQAdm\Catalog\Media\Property\Standard( $this->context );
		$this->object = new \Aimeos\Admin\JQAdm\Common\Decorator\Page( $this->object, $this->context );
		$this->object->setAimeos( \TestHelperJqadm::getAimeos() );
		$this->object->setView( $this->view );
	}


	protected function tearDown()
	{
		unset( $this->object, $this->view, $this->context );
	}


	public function testCreate()
	{
		$manager = \Aimeos\MShop::create( $this->context, 'catalog' );

		$this->view->item = $manager->createItem();
		$result = $this->object->create();

		$this->assertContains( 'Media properties', $result );
		$this->assertNull( $this->view->get( 'errors' ) );
	}


	public function testCopy()
	{
		$manager = \Aimeos\MShop::create( $this->context, 'catalog' );

		$this->view->item = $manager->findItem( 'cafe', ['media'] );
		$result = $this->object->copy();

		$this->assertNull( $this->view->get( 'errors' ) );
		$this->assertContains( 'item-media-property', $result );
	}


	public function testDelete()
	{
		$result = $this->object->delete();

		$this->assertNull( $this->view->get( 'errors' ) );
		$this->assertNull( $result );
	}


	public function testGet()
	{
		$manager = \Aimeos\MShop::create( $this->context, 'catalog' );

		$this->view->item = $manager->findItem( 'cafe', ['media'] );
		$result = $this->object->get();

		$this->assertNull( $this->view->get( 'errors' ) );
		$this->assertContains( 'item-media-property', $result );
	}


	public function testSave()
	{
		$manager = \Aimeos\MShop::create( $this->context, 'catalog' );
		$typeManager = \Aimeos\MShop::create( $this->context, 'media/property/type' );

		$item = $manager->findItem( 'cafe', ['media'] );
		$item->setCode( 'jqadm-test-media-property' );
		$item->setId( null );

		$this->view->item = $manager->insertItem( $item );

		$param = array(
			'site' => 'unittest',
			'media' => array(
				0 => array(
					'property' => array(
						0 => array(
							'media.property.id' => '',
							'media.property.type' => 'size',
						),
					),
				),
			),
		);

		$helper = new \Aimeos\MW\View\Helper\Param\Standard( $this->view, $param );
		$this->view->addHelper( 'param', $helper );


		$result = $this->object->save();


		$manager->deleteItem( $this->view->item->getId() );

		$this->assertNull( $this->view->get( 'errors' ) );
		$this->assertNull( $result );

		$mediaItems = $this->view->item->getRefItems( 'media' );
		$this->assertEquals( 2, count( $mediaItems ) );
		$this->assertEquals( 1, count( reset( $mediaItems )->getPropertyItems() ) );
	}


	public function testSaveException()
	{
		$object = $this->getMockBuilder( \Aimeos\Admin\JQAdm\Catalog\Media\Property\Standard::class )
			->setConstructorArgs( array( $this->context, \TestHelperJqadm::getTemplatePaths() ) )
			->setMethods( array( 'fromArray' ) )
			->getMock();

		$object->expects( $this->once() )->method( 'fromArray' )
			->will( $this->throwException( new \RuntimeException() ) );

		$this->view = \TestHelperJqadm::getView();
		$this->view->item = \Aimeos\MShop::create( $this->context, 'catalog' )->createItem();

		$object->setView( $this->view );

		$this->setExpectedException( \RuntimeException::class );
		$object->save();
	}


	public function testSearch()
	{
		$this->assertNull( $this->object->search() );
	}


	public function testGetSubClient()
	{
		$this->setExpectedException( \Aimeos\Admin\JQAdm\Exception::class );
		$this->object->getSubClient( 'unknown' );
	}
}
