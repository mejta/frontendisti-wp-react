# Ukázka použití Reactu ve WordPressu pro frontendisti.cz

## Předpoklady

1. MacOS, Windows nebo Linux
2. Nainstalovaný Yarn 1.x
3. Nainstalovaný Node > v12.12.0

## Použití

1. Naklonovat obsah repozitáře do `wp-content/plugins/wp-react`
2. Nainstalovat závislosti pomocí `composer instal` a `yarn install`
3. Zkompilovat assety pomocí `yarn build`

## Vývoj

1. Instalace čistého WordPressu na lokální URL
2. Nakopírování pluginu do složky `wp-content`
3. Ve složce pluginu spustit příkaz `yarn start`

## Co v ukázce uvidíte

* Vlastní konfigurace Webpacku (+ babel, eslint, stylelint, apod.)
* Code splitting & dynamic import
* CSS Modules
* React Redux & Redux Toolkit
* Použití React Portálu pro vykreslení částí aplikace kdekoliv na stránce
* React aplikace využívající custom WordPress API
