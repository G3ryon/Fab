import { Component, OnInit } from '@angular/core';
import {PrintInfo,PrintForm,Print} from '../../Interface/Interface.module';
import {ApiService} from "../../services/api.service";
import {formatDate} from "@angular/common";
import { HttpClient } from '@angular/common/http';
import {Router} from "@angular/router";
import {NgbAlertModule} from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-print-form',
  templateUrl: './print-form.component.html',
  styleUrls: ['./print-form.component.css']
})
export class PrintFormComponent implements OnInit {
  Data;
  message;
  type;
  fileData: File = null;
  materials = ["PLA","ABS","FLEX","PETG"];
  hours=["8h","10h","12h","14h","16h","18h"];
  longPrintHours = ["18h"];
  minDate = new Date(2019, 0, 1);
  maxDate = new Date(2021, 0, 1);
  model = new Print(0,"","",0,"PLA",1,0,"");


  myFilter = (d: Date): boolean => {
    const day = d.getDay();
    // Prevent Saturday and Sunday from being selected.
    return day !== 0 && day !== 6;
  };

  //Handling the upload process and request to the API
  fileProgress(fileInput: any) {
    this.fileData = <File>fileInput.target.files[0];
    const formData = new FormData();
    formData.append('File', this.fileData);
    this.api.uploadFIle(formData)
      .subscribe(filename => {this.Data=filename["filename"];});
  }


  onSubmit(){

    this.model.PrintFilename=this.Data;
    //Handling the request to the API and the response code by displaying an alert
    // @ts-ignore
    this.api.newPrintSubmit(this.model).subscribe(res =>{
      switch(res["code"]){
        case 200: {
          this.message='SUCCESS!!: ton print a bien été enregistré :D';
          this.type = "success";
          this.model = new Print(16067,"","",0,"PLA",1,0,"");
          break;
        }
        case 401: {
          this.message='ECHEC : Tu n\'as pas fait la formation 3D!';
          this.type="danger";
          break;
        }
        case 403:{
          this.message='ECHEC : Il y a deja une impression à cette heure là!';
          this.type="danger";
          break;
        }
        case 404:{
          this.message='ECHEC : L\'ECAM n\'est pas accessible ce jour-là';
          this.type="danger";
          break;
        }
      }
    });
  }

  constructor(private api: ApiService,private http: HttpClient, private router:Router) { }

  ngOnInit() {
  }

}
