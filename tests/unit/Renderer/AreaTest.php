<?php
/**
 * Unit tests for the Phighchart\Options\Area class
 */

namespace Phighchart\Test\Renderer;

use Phighchart\Chart;
use Phighchart\Options\Container as OptionsContainer;
use Phighchart\Options\ExtendedContainer as ExtendedOptionsContainer;
use Phighchart\Data;
use Phighchart\Renderer\Area;

class AreaTest extends \PHPUnit_Framework_TestCase
{
    public function testAreaImplementsInterface()
    {
        $area = new Area();
        $this->assertInstanceOf('Phighchart\Renderer\RendererInterface', $area);
    }

    public function testAreaRender()
    {
        $extOptions = new ExtendedOptionsContainer();
        $extOptions->setStickyColour('apples', '#629632');
        $extOptions->setStickyColour('oranges', '#CD3700');

        $options = new OptionsContainer('chart');
        $options->setRenderTo('chart_example_59');
        $options->setMarginRight(130);
        $options->setMarginBottom(25);

        $titleOptions = new OptionsContainer('title');
        $titleOptions->setText('Monthly Details');
        $titleOptions->setX(-20);

        $data = new Data();
        $data->addSeries('Apples', array(
            '2012-05-01' => 12,
            '2012-05-02' => 3,
            '2012-05-03' => 33
        ))
        ->addSeries('Oranges', array(
            '2012-05-01' => 32,
            '2012-05-02' => 36,
            '2012-05-03' => 18
        ));

        // put it all together
        $chart  = new Chart();
        $chart->addOptions($options);
        $chart->addOptions($titleOptions);
        $chart->addOptions($extOptions);
        $chart->setData($data);
        $chart->setRenderer(new Area());

        // test the full expected output
        $this->assertSame(
            'var chart_example_59; chart_example_59 = new Highcharts.Chart({"chart":{"renderTo":"chart_example_59","marginRight":130,"marginBottom":25,"type":"area"},"title":{"text":"Monthly Details","x":-20},"xAxis":{"categories":["2012-05-01","2012-05-02","2012-05-03"]},"series":[{"name":"Apples","data":[12,3,33],"color":"#629632"},{"name":"Oranges","data":[32,36,18],"color":"#CD3700"}]});',
            $chart->render()
        );
        $this->assertSame('<div id="chart_example_59"></div>', $chart->renderContainer());
    }
}
