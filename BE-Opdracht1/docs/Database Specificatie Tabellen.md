# Database Specificatie Tabellen

Database: `be-laravel`

## Stamtabellen

### Producten
- `ProductId`: INT UNSIGNED, primary key, auto increment
- `Naam`: VARCHAR(100), verplicht
- `Barcode`: VARCHAR(20), verplicht en uniek

### Allergenen
- `AllergeenId`: INT UNSIGNED, primary key, auto increment
- `Naam`: VARCHAR(100), verplicht
- `Omschrijving`: VARCHAR(250), verplicht

### Leveranciers
- `LeverancierId`: INT UNSIGNED, primary key, auto increment
- `Naam`: VARCHAR(100), verplicht
- `ContactPersoon`: VARCHAR(100), verplicht
- `LeverancierNummer`: VARCHAR(20), verplicht en uniek
- `Mobiel`: VARCHAR(20), verplicht

## Koppeltabellen

### Magazijnen
- `MagazijnId`: INT UNSIGNED, primary key, auto increment
- `ProductId`: INT UNSIGNED, foreign key naar `producten.ProductId`
- `VerpakkingsEenheidInKilogram`: DECIMAL(5,2), verplicht
- `AantalAanwezig`: INT UNSIGNED, mag NULL zijn

### Product per allergenen
- `ProductPerAllergeenId`: INT UNSIGNED, primary key, auto increment
- `ProductId`: foreign key naar `producten.ProductId`
- `AllergeenId`: foreign key naar `allergenen.AllergeenId`
- Combinatie `ProductId` en `AllergeenId` is uniek

### Product per leveranciers
- `ProductPerLeverancierId`: INT UNSIGNED, primary key, auto increment
- `LeverancierId`: foreign key naar `leveranciers.LeverancierId`
- `ProductId`: foreign key naar `producten.ProductId`
- `DatumLevering`: DATE, verplicht
- `Aantal`: INT UNSIGNED, verplicht
- `DatumEerstVolgendeLevering`: DATE, mag NULL zijn

## Systeemvelden

Alle zes tabellen bevatten:

- `IsActief`: BIT, verplicht, standaardwaarde 1
- `Opmerking`: VARCHAR(250), mag NULL zijn
- `DatumAangemaakt`: DATETIME(6), verplicht
- `DatumGewijzigd`: DATETIME(6), mag NULL zijn
