#  G4R-Priorization (API)

Projeto relativo a API do G4R-Priorization que tem como objetivo auxiliar no processo de priorização de requisitos através de técnicas implementadas na linguagem de programação PHP utilizando o micro-framework Lumen.

## Técnicas Implementadas

O projeto possui a implementação de 4 técnicas de priorização de requisitos, sendo elas: MoSCoW, Dólar 100(Price 100$), AHP e Matriz de Wiegers.

## Desenvolvimento

A API foi desenvolvida por Diógenes Diniz(diogenesdini@gmail.com)

## Descrição das Técnicas
* Dollar 100
  * Method
    - POST
  * URL de Acesso
    - https://priorizacao.herokuapp.com/public/dollar/ranking
  * Entrada
  
  ```
  {
	"requisitos": [{
		"idrequisito" : 1,
		"valor" : 100.0
	},{
		"idrequisito" : 1,
		"valor" : 100.0
	},{
		"idrequisito" : 2,
		"valor" : 50.0
	},{
		"idrequisito" : 2,
		"valor" : 50.0
	},{
		"idrequisito" : 3,
		"valor" : 100.0
	},{
		"idrequisito" : 3,
		"valor" : 1000.0
	}]
  }

  ```
  * Saída
  
  ```
  {
  "success": true,
  "data": [
    {
      "idrequisito": 3,
      "valor": 1100,
      "quantidade_entradas": 2
    },
    {
      "idrequisito": 1,
      "valor": 200,
      "quantidade_entradas": 2
    },
    {
      "idrequisito": 2,
      "valor": 100,
      "quantidade_entradas": 2
    }
  ]
  }
  
  ```
* MoSCoW
  * Method
    - POST
  * URL de Acesso
    - https://priorizacao.herokuapp.com/public/moscow/ranking
  * Entrada
  ```
  {
	"requisitos": [{
		"idrequisito": "casa",
		"entrada": "must"
	},{
		"idrequisito": 2,
		"entrada": "should"
	},{
		"idrequisito": 3,
		"entrada": "could"
	},{
		"idrequisito": 4,
		"entrada": "must"
	},{
		"idrequisito": 4,
		"entrada": "must"
	},{
		"idrequisito": 3,
		"entrada": "want"
	},{
		"idrequisito": 2,
		"entrada": "want"
	},{
		"idrequisito": "casa",
		"entrada": "want"
	}]
	}
  ```
  
  * Saída
  
  ```
  {
  "success": true,
  "data": [
    {
      "idrequisito": 4,
      "must": 2,
      "quantidade_entradas": 2
    },
    {
      "idrequisito": "casa",
      "must": 1,
      "quantidade_entradas": 2,
      "want": 1
    },
    {
      "idrequisito": 2,
      "should": 1,
      "quantidade_entradas": 2,
      "want": 1
    },
    {
      "idrequisito": 3,
      "could": 1,
      "quantidade_entradas": 2,
      "want": 1
    }
  ]
	}
  ```
