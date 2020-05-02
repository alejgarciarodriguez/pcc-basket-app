# Pcc-Basket-App

## Requisitos

* Composer
* PHP 7.3+


## Uso de la CLI

```bash
php bin/console
``` 

## Añadir jugador
```bash
    php bin/console player:create \
        --number=[int] \
        --name=[string] \
        --valuation=[int] \
        --role=(PIVOT|BASE|ALERO|ALA-PIVOT|ESCOLTA)
```

Ejemplo:

```bash
    php bin/console player:create \
        --number=1 \
        --name=Alejandro \
        --valuation=100 \
        --role=BASE
```

## Listar jugadores

```bash
php bin/console player:list [--order=(number|valuation)] [--dir=(asc|desc)]
```

## Borrar jugador
```bash
php bin/console player:remove --number=[int]
```

## Calcular alineaciones

```bash
php bin/console tactic (attack|defense|zone-defense)
```

## Ejecutar tests

```bash
bin/phpunit
```

## Notas

Las operaciones son almacenadas en el fichero "operations.json" y los jugadores en el fichero "players.json".

En app/cli se encuentran los archivos Symfony necesarios para crear el punto de entrada por consola: los comandos, el kernel y la configuración de los servicios.