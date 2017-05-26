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
* AHP
  * Method
    - POST
  * URL de Acesso
    - https://priorizacao.herokuapp.com/public/ahp/ranking
  * Entrada
  ```
  {
    "requisitos": [
      {
        "idrequisito": 1,
        "valores": [
          1,
          0.5,
          0.46,
          0.25
        ]
      },
      {
        "idrequisito": 2,
        "valores": [
          0.29,
          1,
          0.33,
          0.75
        ]
      },
      {
        "idrequisito": 3,
        "valores": [
          0.22,
          0.17,
          1,
          0.32
        ]
      }
      ,
      {
        "idrequisito": 4,
        "valores": [
          0.92,
          0.81,
          0.333,
          1
        ]
      }
    ]
  }
  ```
  * Saída
  
  ```
  {
    "success": true,
    "data": [
      {
        "idrequisito": 1,
        "prioridade": 23.439216871324
      },
      {
        "idrequisito": 2,
        "prioridade": 25.032091170359
      },
      {
        "idrequisito": 3,
        "prioridade": 19.201149002947
      },
      {
        "idrequisito": 4,
        "prioridade": 32.32754295537
      }
    ]
  }
  ```  
* Wiegers
  * Method
    - POST
  * URL de Acesso
    - https://priorizacao.herokuapp.com/public/wiegers/ranking
  * Entrada
  ```
  {
  	"peso_beneficio": 4,
  	"peso_custo": 1,
  	"peso_risco": 2,
  	"peso_prejuizo": 4,
  	"requisitos": [{
  		"idrequisito": 1,
  		"beneficio": 2,
  		"prejuizo": 2,
  		"risco": 2,
  		"custo": 2
  	},{
  		"idrequisito" : 2,
  		"beneficio" : 6,
  		"prejuizo" : 3,
  		"risco" : 2,
  		"custo" : 2
  	}]
  }
  ```
  * Saída
  
  ```
  {
    "success": true,
    "data": [
      {
        "idrequisito": 2,
        "beneficio": 6,
        "prejuizo": 3,
        "risco": 2,
        "custo": 2,
        "beneficio_prejuizo": 36,
        "porcentagem_beneficio_prejuizo": 100,
        "porcentagem_custo": 50,
        "porcentagem_risco": 50,
        "prioridade": 0.66666666666667
      },
      {
        "idrequisito": 1,
        "beneficio": 2,
        "prejuizo": 2,
        "risco": 2,
        "custo": 2,
        "beneficio_prejuizo": 16,
        "porcentagem_beneficio_prejuizo": 44.444444444444,
        "porcentagem_custo": 50,
        "porcentagem_risco": 50,
        "prioridade": 0.2962962962963
      }
    ]
  }
  ```  