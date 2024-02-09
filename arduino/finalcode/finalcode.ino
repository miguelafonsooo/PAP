#include <Servo.h>
#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 53  // Pino para SDA (SS) no Arduino Mega
#define RST_PIN 8
#define BUTTON_PIN 22 // Pino do botão

Servo meuServo;  // Objeto do Servo
MFRC522 mfrc522(SS_PIN, RST_PIN);

unsigned long tempoInicial = 0;
bool girarServo = false;

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();
  pinMode(BUTTON_PIN, INPUT_PULLUP);

  meuServo.attach(9); // Conecta o servo ao pino digital 9
}

void loop() {
  // Verificar se o botão foi pressionado
  if (digitalRead(BUTTON_PIN) == LOW) {
    // Adicione aqui a lógica para descontar o preço do produto
    // Certifique-se de enviar um comando específico para o Node-RED, por exemplo, 'B'
    Serial.println("B");
    delay(1000); // Aguarde um pouco para evitar leituras múltiplas
  }

  // Lógica RFID aqui...
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    String cardUID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardUID += String(mfrc522.uid.uidByte[i], HEX);
    }

    // Envia o UID para o computador via porta serial
    Serial.println(cardUID);

    // Aguarda um pouco para evitar leituras múltiplas
    delay(1000);
  }

  // Verificar se a compra foi realizada através do monitor serial
  if (Serial.available() > 0) {
    String input = Serial.readStringUntil('\n'); // lê a entrada do Serial Monitor
    Serial.println(input); // exibe a entrada recebida no Serial Monitor
    if (input.equals("compra1")) {
      moveServo(); // move o servo para 180 graus
    } else if (input.equals("finalizar")) {
      stopServo(); // para o servo
    }
  }
}

void moveServo() {
  meuServo.write(180); // move o servo para 180 graus
  delay(1000); // espera 1 segundo
}

void stopServo() {
  meuServo.write(90); // para o servo na posição central (90 graus)
}
