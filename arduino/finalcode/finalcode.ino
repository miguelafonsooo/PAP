#include <Servo.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Definições dos pinos
#define SS_PIN 53         // Pino para SDA (SS) no Arduino Mega
#define RST_PIN 8
#define BUTTON_PIN_1 22   // Pino do botão 1
#define BUTTON_PIN_2 23   // Pino do botão 2
#define BUTTON_PIN_3 24   // Pino do botão 3
#define BUTTON_PIN_4 25   // Pino do botão 4

// Inicialização dos objetos
Servo servo1;             // Objeto do Servo 1
Servo servo2;             // Objeto do Servo 2
Servo servo3;             // Objeto do Servo 3
Servo servo4;             // Objeto do Servo 4
MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal_I2C lcd(0x27, 16, 2);

void setup() {
  // Inicialização dos dispositivos
  SPI.begin();
  mfrc522.PCD_Init();
  pinMode(BUTTON_PIN_1, INPUT_PULLUP);
  pinMode(BUTTON_PIN_2, INPUT_PULLUP);
  pinMode(BUTTON_PIN_3, INPUT_PULLUP);
  pinMode(BUTTON_PIN_4, INPUT_PULLUP);
  servo1.attach(9);       // Conecta o servo 1 ao pino digital 9
  servo2.attach(10);      // Conecta o servo 2 ao pino digital 10
  servo3.attach(11);      // Conecta o servo 3 ao pino digital 11
  servo4.attach(12);      // Conecta o servo 4 ao pino digital 12
  lcd.init();
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.clear();
  Serial.begin(9600);
  lcd.print("Passe o cartao."); // Mensagem inicial no LCD
}

void loop() {
  // Lógica RFID
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    String cardUID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardUID += String(mfrc522.uid.uidByte[i], HEX);
    }
    Serial.println(cardUID); // Imprime o UID do cartão RFID
    delay(500); // Aguarda um segundo
  }

  // Verificar comandos enviados pela porta serial
  if (Serial.available() > 0) {
    String input = Serial.readStringUntil('\n');
    Serial.println(input);
    // Controla os servos de acordo com o comando recebido
    if (input.equals("compra1")) {
      moveServo(servo1, 10); // Move o servo 1 para o ângulo 10 (sentido anti-horário)
    } else if (input.equals("compra2")) {
      moveServo(servo2, 10); // Move o servo 2 para o ângulo 10 (sentido anti-horário)
    } else if (input.equals("compra3")) {
      moveServo(servo3, 10); // Move o servo 3 para o ângulo 10 (sentido anti-horário)
    } else if (input.equals("compra4")) {
      moveServo(servo4, 10); // Move o servo 4 para o ângulo 10 (sentido anti-horário)
    } else if (input.equals("finalizar")) {
      stopServos();
    } else if (input.startsWith("g")) {
      String message = input.substring(1); // Remove o caractere de controle "g"
      displayMessage(message); // Exibe a mensagem no LCD
    }
  }

  // Verificar botões físicos e enviar comandos pela porta serial
  if (digitalRead(BUTTON_PIN_1) == LOW) {
    Serial.println("B"); // Envia o comando "B" pela porta serial
    delay(500); // Aguarda um segundo
  } else if (digitalRead(BUTTON_PIN_2) == LOW) {
    Serial.println("C"); // Envia o comando "C" pela porta serial
    delay(500); // Aguarda um segundo
  } else if (digitalRead(BUTTON_PIN_3) == LOW) {
    Serial.println("D"); // Envia o comando "D" pela porta serial
    delay(500); // Aguarda um segundo
  } else if (digitalRead(BUTTON_PIN_4) == LOW) {
    Serial.println("E"); // Envia o comando "E" pela porta serial
    delay(500); // Aguarda um segundo
  }
}

// Função para mover um servo para um ângulo específico (sentido anti-horário)
void moveServo(Servo servo, int angle) {
  int pulseWidth = map(angle, 0, 180, 1000, 2000); // Mapeia o ângulo para a faixa de pulsos em microssegundos
  servo.writeMicroseconds(pulseWidth); // Move o servo para a posição especificada
   // Aguarda um segundo
}

// Função para parar todos os servos
void stopServos() {
  servo1.write(90); // Define a posição do servo 1 para 90 graus
  servo2.write(90); // Define a posição do servo 2 para 90 graus
  servo3.write(90); // Define a posição do servo 3 para 90 graus
  servo4.write(90); // Define a posição do servo 4 para 90 graus
}

// Função para exibir uma mensagem no LCD
void displayMessage(String message) {
  lcd.clear(); // Limpa o LCD
  lcd.setCursor(0, 0); // Define o cursor na primeira linha
  lcd.print(message.substring(0, 16)); // Imprime os primeiros 16 caracteres da mensagem na primeira linha
  // Verifica se há mais texto para exibir
  if (message.length() > 16) {
    // Calcula o número de caracteres restantes
    int remainingChars = message.length() - 16;
    // Imprime o texto restante em linhas adicionais
    for (int i = 0; i < remainingChars; i += 16) {
      lcd.setCursor(0, 1); // Define o cursor na segunda linha
      // Imprime o texto restante, limitado a 16 caracteres por linha
      lcd.print(message.substring(16 + i, min(16 + i + 16, message.length())));
    }
  }
}
