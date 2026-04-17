precoGasolina = float(input("Preço da gasolina: "))
precoAlcool = float(input("Preço do alcool: "))
consumoGasolina = float(input("Consumo da gasolina: "))
consumoAlcool = float(input("Consumo da alcool: "))
distancia = float(input("Distancia: "))
qtdPessoas = int(input("Quantas pessoas? "))

#processamento
litrosGasolina = distancia / consumoGasolina
totalGasolina = litrosGasolina * precoGasolina
individualGasolina = totalGasolina / qtdPessoas

litrosAlcool = distancia / consumoAlcool
totalAlcool = litrosAlcool * precoAlcool
individualAlcool = totalAlcool / qtdPessoas

print("Litros de Gasolina: "+ str(litrosGasolina)) 
print("Total de Gasolina em R$"+ str(totalGasolina))
print("Total Individual em R$" + str(individualGasolina))

print("Litros de Alcool: "+ str(litrosAlcool))
print("Total de Alcool em R$"+ str(totalAlcool))
print("Total Individual em R$" + str(individualAlcool))


if(totalAlcool > totalGasolina):
    diferenca = str(totalAlcool - totalGasolina)
    print("Abasteça com Gasolina" + diferenca)
else:
    diferenca = str(totalGasolina - totalAlcool)
    print("Abasteça com Alcool" + diferenca)
