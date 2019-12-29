import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';



@NgModule({
  declarations: [],
  imports: [
    CommonModule
  ]
})
export class InterfaceModule { }
export interface PrintInfo {
  "PrintFilename": string;
  "id": number;
  "Nom": string;
  "Temps": number;
  "Matiere": string;
  "Prix": number;
  "Heure": number;
  "Utilisateur": utilisateur[];

}
export interface utilisateur{
  "id": number;
  "nom": string;
  "prenom":  string;
}
export class Print{
  constructor(
  public Noma: number,
  public Date: string,
  public Nom: string,
  public Temps: number,
  public Matiere: string,
  public Prix: number,
  public Heure: number,
  public PrintFilename: string

  ) {}

}
export class Formationbool {
  constructor(
    public Noma: number,
    public bool: boolean,

  ) {
  }
}
export interface uploadfile{
  "filename": string;
}
export interface PrintForm{
  "code": number;
}
