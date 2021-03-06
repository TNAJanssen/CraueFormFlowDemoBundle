<?php

namespace Craue\FormFlowDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2013 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Vehicle {

	/**
	 * @var integer
	 * @ORM\Column(name="number_of_wheels", type="integer", nullable=false)
	 * @Assert\Choice(callback="getValidWheels", groups={"flow_createVehicle_step1"})
	 * @Assert\NotBlank(groups={"flow_createVehicle_step1"})
	 */
	public $numberOfWheels;

	/**
	 * @var string
	 * @ORM\Column(name="engine", type="string", nullable=true)
	 * @Assert\Choice(callback="getValidEngines", groups={"flow_createVehicle_step2"})
	 * @Assert\NotBlank(groups={"flow_createVehicle_step2"})
	 */
	public $engine;

	public function canHaveEngine() {
		return $this->numberOfWheels === 4;
	}

	public static function getValidWheels() {
		return array(
			2,
			4,
		);
	}

	public static function getValidEngines() {
		return array(
			'ELECTRIC',
			'GAS',
			'NATURAL_GAS',
		);
	}

}
