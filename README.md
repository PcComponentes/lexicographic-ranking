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

The char pool to create the rankings. Numeric, alphanumeric36(only uppercase letters) and alphanumeric62(both upper case and lower case) are available.
To create a custom one implement TokenSetInterface. 

### Gap
The space to be left before a ranking. With a gap of 1 the next ranking to 'A' would be 'B', with a gap of 8 that would be 'I'.  
