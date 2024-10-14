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

class DataTables extends Entity implements IEntity {
  use ToArray;

  public const Keyword = 'keyword';
  public const SearchBy = 'search_by';
  public const OrderBy = 'order_by';
  public const Page = 'page';
  public const Limit = 'limit';


  public const DefaultPage = 1;
  public const MinimumLimit = 5;
  public const MaximumLimit = 100;
  public const OrderASC = 'asc';
  public const OrderDESC = 'desc';


  /** @var null|string $keyword */
  private ?string $keyword = null;
  /** @var null|string[] $search_by */
  private ?array $search_by = null;
  /** @var null|string[][] $order_by */
  private ?array $order_by = null;
  /** @var null|int $page */
  private ?int $page = 0;
  /** @var null|int $limit */
  private ?int $limit = self::MinimumLimit;

  /**
   * @param null|string $keyword
   * @param null|array $search_by
   * @param null|array $order_by
   * @param null|int $page
   * @param null|int $limit
   *
   * @return \App\Domain\Entity\DataTables
   * @throws \App\Exceptions\EntityValidationException
   * @throws \Illuminate\Validation\ValidationException
   */
  public static function create(?string $keyword = null, ?array $search_by = null, ?array $order_by = null,
    ?int $page = self::DefaultPage, ?int $limit = self::MinimumLimit) : DataTables {
    $payload = (new self)->validate(
      [
        self::Keyword => $keyword,
        self::SearchBy => $search_by,
        self::OrderBy => $order_by,
        self::Page => $page,
        self::Limit => $limit
      ],
      [
        self::Keyword => ['nullable', 'string'],
        self::SearchBy => ['nullable', 'array'],
        self::OrderBy => ['nullable', 'array'],
        self::Page => ['nullable', 'integer', 'min:1'],
        self::Limit => ['nullable', 'integer', ('min:' . self::MinimumLimit), ('max:' . self::MaximumLimit)],
      ]
    );

    return self::rebuild($payload[self::Keyword], $payload[self::SearchBy], $payload[self::OrderBy],
      $payload[self::Page], $payload[self::Limit]);
  }

  /**
   * @param null|string $keyword
   * @param null|array $search_by
   * @param null|array $order_by
   * @param null|int $page
   * @param null|int $limit
   *
   * @return \App\Domain\Entity\DataTables
   */
  public static function rebuild(?string $keyword = null, ?array $search_by = null, ?array $order_by = null,
    ?int $page = self::DefaultPage, ?int $limit = self::MinimumLimit) : DataTables {
    $self = new self;
    if(!empty(trim($keyword))) {
      $self->keyword = trim($keyword);
    }

    if(!empty(trim($search_by))) {
      $self->search_by = $search_by;
    }

    if(!empty(trim($order_by))) {
      $self->order_by = $order_by;
    }

    $self->page = (!empty($page) && $page > 0) ? $page : 1;
    $self->limit = (!empty($limit) && $limit > 0) ? $limit : self::MinimumLimit;
    if($self->limit > self::MaximumLimit) {
      $self->limit = self::MaximumLimit;
    }

    return $self;
  }

  /**
   * @return null|string
   */
  public function getKeyword() : ?string {
    return $this->keyword;
  }

  /**
   * @return null|string[]
   */
  public function getSearchBy() : ?array {
    return $this->search_by;
  }

  /**
   * @return null|\string[][]
   */
  public function getOrderBy() : ?array {
    return $this->order_by;
  }

  /**
   * @return null|int
   */
  public function getPage() : ?int {
    return $this->page;
  }

  /**
   * @return null|int
   */
  public function getLimit() : ?int {
    return $this->limit;
  }
}
