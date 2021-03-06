<?php
declare(strict_types=1);

namespace LotGD\Module\DragonKills\Models;

use DateTime;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

use LotGD\Core\Models\SaveableInterface;
use LotGD\Core\Models\Character;
use LotGD\Core\Tools\Model\Saveable;
use LotGD\Module\DragonKills\Module as DragonKillModule;
use LotGD\Module\DragonKills\Tests\Helpers\DragonKillsEvent;

/**
 * Model for tracking dragon kills, including who and when they slayed the
 * horrid beast.
 * @Entity
 * @Table(name="lotgd_dragon_kills")
 */
class DragonKill implements SaveableInterface
{
    use Saveable;

    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;
    /**
     * @ManyToOne(targetEntity="LotGD\Core\Models\Character", fetch="EAGER")
     * @JoinColumn(name="killer_id", referencedColumnName="id", nullable=false)
     */
    private $killer;
    /** @Column(type="text", nullable=false) */

    /** @Column(type="datetime", nullable=false) */
    private $killedAt;

    /** @Column(type="datetime", nullable=false) */
    private $createdAt;

    /** @var array */
    private static $fillable = [
        "killer",
        "killedAt",
    ];

    /**
     * Construct a new dragon kill.
     *
     * @param \LotGD\Core\Models\Character $killer
     * @param DateTime $gameTime The game time at which this kill occurred.
     */
    public function __construct(Character $killer, DateTime $gameTime)
    {
        $this->killer = $killer;
        $this->killedAt = $gameTime;
        $this->createdAt = new DateTime();
    }

    /**
     * Returns the id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Returns the character who did the killing.
     * @return \LotGD\Core\Models\Character
     */
    public function getKiller(): Character
    {
        return $this->killer;
    }

    /**
     * Returns the game time at which the killing occurred.
     * @return DateTime
     */
    public function getKilledAt(): DateTime
    {
        return $this->killedAt;
    }

    /**
     * Returns the datetime this message was created at
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
