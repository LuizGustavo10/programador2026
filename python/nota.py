nota1 = int(input("Insira a nota 1: "))
nota2 = int(input("Insira a nota 2: "))
nota3 = int(input("Insira a nota 3: "))
nota4 = int(input("Insira a nota 4: "))

#faça um algoritmo que ache a média das notas
#se a nota for inferior a 60 reprovado
#se a nota for acima de 60 é aprovado

media = (nota1 + nota2 + nota3 + nota4) / 4
print(media)
if(media >= 60):
    print("Parabéns, você está aprovado! ")
else:
    print("Reprovado!")
media = (nota1 + nota2 + nota3 + nota4) / 4
#analisando vários casos
if(media >= 90):
    print("Parabéns, você foi excelente! ")
elif(media >= 80):
    print("Sua nota foi muito boa! ")
elif(media >= 70):
    print("Nota boa 👍")
elif(media >= 60):
    print("Passou na rapa! ")
else:
    print("Infelizmente reprovou!")