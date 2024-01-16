#include <Wire.h>
#include <LiquidCrystal_I2C.h>

// Inicializa o display no endereço 0x27
LiquidCrystal_I2C lcd(0x27, 16, 2); // 16 colunas, 2 linhas

void setup() {
  lcd.begin(16, 2);
}

void loop() {
  lcd.setBacklight(HIGH);
  lcd.setCursor(0, 0);
  lcd.print("ElectroFun.pt");
  lcd.setCursor(0, 1);
  lcd.print("LCD e modulo I2C");
  delay(1000);
  lcd.setBacklight(LOW);
  delay(1000);
}
