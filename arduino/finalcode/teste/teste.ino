#include <Servo.h>
#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 53       // Pino para SDA (SS) no Arduino Mega
#define RST_PIN 8
#define BUTTON_PIN_22 22 // Pino do botão 22
#define BUTTON_PIN_23 23 // Pino do botão 23

Servo meuServo1;  // Objeto do Servo 1
Servo meuServo2;  // Objeto do Servo 2
MFRC522 mfrc522(SS_PIN, RST_PIN);

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();
  pinMode(BUTTON_PIN_22, INPUT_PULLUP);
  pinMode(BUTTON_PIN_23, INPUT_PULLUP);

  meuServo1.attach(9); // Conecta o servo 1 ao pino digital 9
  meuServo2.attach(10); // Conecta o servo 2 ao pino digital 10
}

void loop() {
  // Verificar se o botão 22 foi pressionado
  if (digitalRead(BUTTON_PIN_22) == LOW) {
    Serial.println("B");
    delay(1000); // Aguarde um pouco para evitar leituras múltiplas
  }

  // Verificar se o botão 23 foi pressionado
  if (digitalRead(BUTTON_PIN_23) == LOW) {
    Serial.println("C");
    delay(1000); // Aguarde um pouco para evitar leituras múltiplas
  }

  // Lógica RFID aqui...
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    String cardUID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardUID += String(mfrc522.uid.uidByte[i], HEX);
    }

    Serial.println(cardUID);
    delay(1000);
  }

  // Verificar se a compra foi realizada através do monitor serial
  if (Serial.available() > 0) {
    String input = Serial.readStringUntil('\n');
    Serial.println(input);

    if (input.equals("compra1")) {
      moveServo1();
    } else if (input.equals("compra2")) {
      moveServo2();
    } else if (input.equals("finalizar")) {
      stopServos();
    }
  }
}

void moveServo1() {
  meuServo1.write(180);
  delay(1000);
}

void moveServo2() {
  meuServo2.write(180);
  delay(1000);
}

void stopServos() {
  meuServo1.write(90);
  meuServo2.write(90);
}
