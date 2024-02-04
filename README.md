
# API Response 200

Dokumentasi ini untuk menjelaskan API Dari Tabel Players dan terhubung dengan Tabel Games


## API Reference

#### players

```http Response 200
  GET/api/players
  GET/api/players/{playersid}
  POST/api/players
  PUT/api/players/{playersid}
  DELETE/api/players/{playersid}
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `id`      | `integer`| **Required**               |
| `nickname`| `string` |                            |
| `username`| `string` |                            |
| `email`   | `string` |                            |


#### games

```http Response 200
  GET /api/games
  GET/api/games/{gamesid}
  POST/api/games
  PUT/api/games/{gamesid}
  DELETE/api/games/{gamesid}
```

| Parameter  | Type     | Description                         |
| :--------- | :------- | :---------------------------------- |
| `id`       | `integer`| **Required**                        |
| `id_player'| `integer`| **Required**                        |
| `game_name`| `string` |                                     |
| `platform` | `string` |                                     |
| `game_type`| `string` |                                     |




