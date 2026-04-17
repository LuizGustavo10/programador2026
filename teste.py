print("Olá mundo")

#ENTRADA - variáveis - armazenam valores
alcool = 4.45
gasolina = 7.05
nome = "João"
alcool = float(input("Digite valor do alcool: "))
gasolina = float(input("Digite valor da gasolina: "))
nome = input("Insira seu nome: ")


# PROCESSAMENTO - variavel total armazena o resultado da divisão
total = alcool / gasolina
print(total)

if(total > 0.7):
    #SAÍDA
    print("Abasteça com Gasolina "+nome)
else:
    print("Abasteça com Alcool "+nome)

