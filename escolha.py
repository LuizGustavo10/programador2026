import random
import os
import sys
import time
import webbrowser
from playsound3 import playsound

def abrir_navegador():
    urls =[
        "https://www.pr.senac.br",
        "https://www.youtube.com",
        "https://www.google.com",
        "https://www.wikipedia.org"
    ]
    for site in urls:
        webbrowser.open(site)

def desligar():
    time.sleep(5)
    if sys.platform == 'win32':
        os.system("shutdown /s /t 1") #para windows
    elif sys.platform == 'linux' or sys.platform == 'linux2':
        os.system("shutdown now") #para linux
    elif sys.platform == "darwin":
        os.system("shutdown -h now")


def evento_aleatorio():
    num_opcoes = 3
    escolha_indesejada = random.randint(1, num_opcoes)

    escolha = int(input(f"Escolha um número entre 1 e {num_opcoes}: "))
    if escolha == escolha_indesejada:
        print("Ops! o Pc será desligado 💣🧨💥 ")
        playsound('alarme.mp3')
        abrir_navegador()
        # desligar()
    else:
        playsound('certa-resposta.mp3')
        print("Você está seguro, por enquanto! 😁 ")

evento_aleatorio()