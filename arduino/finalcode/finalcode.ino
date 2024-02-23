#include <Servo.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

#define SS_PIN 53       // Pino para SDA (SS) no Arduino Mega
#define RST_PIN 8
#define BUTTON_PIN_1 22 // Pino do botão 1
#define BUTTON_PIN_2 23 // Pino do botão 2
#define BUTTON_PIN_3 24 // Pino do botão 3
#define BUTTON_PIN_4 25 // Pino do botão 4

Servo servo1;           // Objeto do Servo 1
Servo servo2;           // Objeto do Servo 2
Servo servo3;           // Objeto do Servo 3
Servo servo4;           // Objeto do Servo 4
MFRC522 mfrc522(SS_PIN, RST_PIN);
LiquidCrystal_I2C lcd(0x27, 16, 2);

void setup() {
  SPI.begin();
  mfrc522.PCD_Init();
  pinMode(BUTTON_PIN_1, INPUT_PULLUP);
  pinMode(BUTTON_PIN_2, INPUT_PULLUP);
  pinMode(BUTTON_PIN_3, INPUT_PULLUP);
  pinMode(BUTTON_PIN_4, INPUT_PULLUP);
  servo1.attach(9);     // Conecta o servo 1 ao pino digital 9
  servo2.attach(10);    // Conecta o servo 2 ao pino digital 10
  servo3.attach(11);    // Conecta o servo 3 ao pino digital 11
  servo4.attach(12);    // Conecta o servo 4 ao pino digital 12
  lcd.init();
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.clear();
  Serial.begin(9600);
  lcd.print("Passe o cartao.");
}

void loop() {


  // Lógica RFID
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    String cardUID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardUID += String(mfrc522.uid.uidByte[i], HEX);
    }
    Serial.println(cardUID);
    delay(1000);
  }

  // Verificar botões e acionar os microservos
  if (Serial.available() > 0) {
    String input = Serial.readStringUntil('\n');
    Serial.println(input);
    if (input.equals("compra1")) {
      moveServo(servo1, 180);
    } else if (input.equals("compra2")) {
      moveServo(servo2, 180);
    } else if (input.equals("compra3")) {
      moveServo(servo3, 180);
    } else if (input.equals("compra4")) {
      moveServo(servo4, 180);
    } else if (input.equals("finalizar")) {
      stopServos();
    } else if (input.startsWith("g")) {
      String message = input.substring(1); // Remove o caractere de controle "g"
      displayMessage(message);
    }
  }

  // Verificar botões físicos
  if (digitalRead(BUTTON_PIN_1) == LOW) {
    Serial.println("B");
    delay(1000);
  } else if (digitalRead(BUTTON_PIN_2) == LOW) {
    Serial.println("C");
    delay(1000);
  } else if (digitalRead(BUTTON_PIN_3) == LOW) {
    Serial.println("D");
    delay(1000);
  } else if (digitalRead(BUTTON_PIN_4) == LOW) {
    Serial.println("E");
    delay(1000);
  }

 
}
void moveServo(Servo servo, int angle) {
  servo.write(angle);
  delay(1000);
}

void stopServos() {
  servo1.write(90);
  servo2.write(90);
  servo3.write(90);
  servo4.write(90);
}

void displayMessage(String message) {
  lcd.clear();
  lcd.setCursor(0, 0);
  
  // Imprime a primeira linha
  lcd.print(message.substring(0, 16));
  
  // Verifica se há mais texto para exibir
  if (message.length() > 16) {
    // Calcula o número de caracteres restantes
    int remainingChars = message.length() - 16;
    // Imprime o texto restante em linhas adicionais
    for (int i = 0; i < remainingChars; i += 16) {
      lcd.setCursor(0, 1); // Muda para a segunda linha
      lcd.print(message.substring(16 + i, min(16 + i + 16, message.length())));
    }
  }
}
