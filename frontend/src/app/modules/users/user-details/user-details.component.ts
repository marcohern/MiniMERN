import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-user-details',
  templateUrl: './user-details.component.html',
  styleUrls: ['./user-details.component.css']
})
export class UserDetailsComponent implements OnInit {

  public userForm:FormGroup;

  constructor(private fb:FormBuilder) { }

  ngOnInit() {
    this.userForm = this.fb.group({
      email: this.fb.control('',[Validators.required, Validators.email]),
      name: this.fb.control('',[Validators.required]),
      desc: this.fb.control('',[]),
    });
  }

}
