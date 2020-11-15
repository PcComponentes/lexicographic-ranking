# Lexicographic Ranking

### Usage

```php
$calculator = new RankingCalculator(
    new RankingCalculatorConfig(
        new Alpha36TokenSet(),
        RankingCalculatorConfig::DEFAULT_GAP
    )
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

To create a custom one extend TokenSet. 

### Gap
The space to be left before a ranking. With a gap of 1 the next ranking to 'A' would be 'B', with a gap of 8 that would be 'I'.  
