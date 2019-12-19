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
  previewUrl:any = null;
  fileUploadProgress: string = null;
  uploadedFilePath: string = null;
  materials = ["PLA","ABS","FLEX","PETG"];
  hours=["8h","10h","12h","14h","16h","18h"];
  model = new Print(0,"","","","PLA",1,0,"");


  myFilter = (d: Date): boolean => {
    const day = d.getDay();
    // Prevent Saturday and Sunday from being selected.
    return day !== 0 && day !== 6;
  };

  fileProgress(fileInput: any) {
    this.fileData = <File>fileInput.target.files[0];
    const formData = new FormData();
    formData.append('File', this.fileData);
    this.api.uploadFIle(formData)
      .subscribe(filename => {this.Data=filename["filename"];});
  }


  onSubmit(){
   console.log(this.Data);
    this.model.PrintFilename=this.Data;
    // @ts-ignore
    this.api.newPrintSubmit(this.model).subscribe(res =>{
      if(res["code"] == 200){
        this.message='SUCCESS!!: ton print a bien été enregistré :D';
        this.type = "success";
        this.model = new Print(16067,"","","","PLA",1,0,"");
      }
      else if(res["code"] == 403){
        this.message='ECHEC : Il y a deja un print à cette heure là!';
        this.type="danger"
      }
      else if(res["code"] == 401){
        this.message='ECHEC : Tu n\'as pas fait la formation 3D!';
        this.type="danger"
      }
    }  );

  }

  constructor(private api: ApiService,private http: HttpClient, private router:Router) { }

  ngOnInit() {
  }

}
