<?php
/*
//
//  ______    _   _           _  __      _   _     ____   ___
// |  ____|  | | | |         | |/ _|    | | | |   |___ \ / _ \
// | |__ __ _| |_| |__   __ _| | |_ __ _| |_| |__   __) | | | |
// |  __/ _` | __| '_ \ / _` | |  _/ _` | __| '_ \ |__ <| | | |
// | | | (_| | |_| | | | (_| | | || (_| | |_| | | |___) | |_| |
// |_|  \__,_|\__|_| |_|\__,_|_|_| \__,_|\__|_| |_|____/ \___/
//
// Written by Fathalfath30.
// Email : fathalfath30@gmail.com
// Follow me on:
//  Github : https://github.com/fathalfath30
//  Gitlab : https://gitlab.com/Fathalfath30
//
*/

namespace App\Domain\Entity;

use App\Domain\Entity\Traits\Entity;
use App\Domain\Entity\Traits\ToArray;

/**
 * DataTables
 * This entity should be used to handle basic data tables
 * query such as searching using keyword, pagination and
 * sorting
 *
 * @author Fathalfath30
 * @version 1.0.0
 * @since 1.0.0
 *
 * @see \App\Domain\Entity\IEntity
 * @see \App\Domain\Entity\Traits\Entity
 * @see \App\Domain\Entity\Traits\ToArray
 *
 */
class DataTables extends Entity implements IEntity {
  use ToArray;

  const MIN_PAGE_THRESHOLD = 1;
  const MAX_LIMIT_THRESHOLD = 100;

  /** @var null|string $search_by */
  private ?string $search_by = null;

  /** @var null|string $keyword */
  private ?string $keyword = null;

  /** @var int $page */
  private int $page;

  /** @var int $limit */
  private int $limit;

  /** @var array $order_by */
  private array $order_by;

  /**
   * @param null|string $keyword keyword to search
   * @param string|null $search_by search by field name
   * @param int $page current page
   * @param int $limit limit row per page
   * @param array $order_by order by
   *
   * @author Fathalfath30
   *
   * @version 1.0.0
   */
  public function __construct(?string $keyword = null, string $search_by = null, int $page = 1, int $limit = 10,
    array $order_by = []) {
    if(!empty($keyword)) {
      $this->keyword = trim($keyword);
      if(!empty($search_by)) {
        $this->search_by = trim($search_by);
      }
    }

    $this->page = $page;
    if($this->page < self::MIN_PAGE_THRESHOLD) {
      $this->page = self::MIN_PAGE_THRESHOLD;
    }

    $this->limit = $limit;
    if($this->limit > self::MAX_LIMIT_THRESHOLD) {
      $this->limit = self::MAX_LIMIT_THRESHOLD;
    }

    $this->order_by = $order_by;
  }

  /**
   * Get $search_by value
   *
   * @return null|string
   * @author Fathalfath30
   *
   * @version 1.0.0
   */
  public function getSearchBy() : ?string {
    return $this->search_by;
  }

  /**
   * Get $keyword values
   *
   * @return null|string
   * @author Fathalfath30
   *
   * @version 1.0.0
   */
  public function getKeyword(bool $lowerCase = true) : ?string {
    return ($lowerCase) ?
      strtolower($this->keyword) : $this->keyword;
  }

  /**
   * Get $page value
   *
   * @return int
   * @author Fathalfath30
   *
   * @version 1.0.0
   */
  public function getPage() : int {
    return $this->page;
  }

  /**
   * Get $limit value
   *
   * @return int
   * @author Fathalfath30
   *
   * @version 1.0.0
   *
   */
  public function getLimit() : int {
    return $this->limit;
  }

  /**
   * Get $order_by value
   *
   * @return array|string[]
   * @author Fathalfath30
   *
   * @version 1.0.0
   */
  public function getOrderBy() : array {
    return $this->order_by;
  }
}
