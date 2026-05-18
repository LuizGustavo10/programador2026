import random
opcao = -1



#trabalhando com estrutura de listas/vetor
#           0          1        2       3        4
nomes = ["Jorge", "Maria"]
def inserir():
    qtdPessoas = int(input("Quantas pessoas vai inserir? "))
    for i in range(qtdPessoas):
        nome = input("Insira o nome: ")
        nomes.append(nome)


def listar():
    #imprimindo um item individual
    print(nomes[1])
    #estraturas de repetição (looping)
    for contador in nomes:
        print(contador)
    limite = 5
    numero = 2
    while numero <= limite:
        print("O numero da vês é: ", numero)
        numero = numero + 1



def sortear():
    qtd = int(input("Insira quantos você quer sortear?"))
    sortudos = []
    while qtd != len(sortudos):
        sorteado = random.choice(nomes)
        #se estiver dentro da lista de sortudos, sorteia novamente
        if(sorteado in sortudos):
            sorteado = random.choice(nomes)
        else:
            sortudos.append(sorteado)
            print("O sorteador é ooooooo: ", sorteado)

    
        
    





while opcao != 4:
    print('''
    Digite umas das seguintes opções:
    1 - para inserir nome
    2 - para ver nomes
    3 - para sortear
    4 - para sair
    ''')
    opcao = int(input("Insira a opção:"))
    if opcao == 1:
        inserir()
    elif opcao == 2:
        listar()
    elif opcao == 3:
        sortear()
    else:
        print("Essa não é uma opção válida")







  




