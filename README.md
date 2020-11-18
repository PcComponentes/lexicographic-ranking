# Lexicographic Ranking

Lexicographic order calculator, useful for persisting ordered lists.


## Installation

Install via [composer](https://getcomposer.org/)

```shell
composer require pccomponentes/lexicographic-ranking
```

## Usage

```php
$calculator = new RankingCalculator(
    new Alpha36TokenSet(),
    new Position(Position::TYPE_FIXED_GAP_START, Position::DEFAULT_GAP)
);

$calculator->between('AAA', 'ZZZ');
```

## Config options
### Token sets

The char pool to create the rankings. The following are available:
```
NumericTokenSet (0-9)
Alpha36TokenSet (0-9 and A-Z)
Alpha62TokenSet (0-9 and A-z)
```
To create a custom one extend from TokenSet. 

### Position
The space to be left between ranks. The following modes are available:
```
Position::TYPE_FIXED_GAP_START // Leaves "gap value" amount of spaces after the first input, gap value must be specified
Position::TYPE_FIXED_GAP_END   // Leaves "gap value" amount of spaces before the second input, gap value must be specified
Position::TYPE_DYNAMIC_MID     // Leaves the same space before and after the result, gap value is ignored 
```
