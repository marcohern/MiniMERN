import { Component, OnInit } from '@angular/core';
import { User } from '../user';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-list',
  templateUrl: './user-list.component.html',
  styleUrls: ['./user-list.component.css']
})
export class UserListComponent implements OnInit {

  public users:User[] = [
    { id:1, name:"Brad Pitt", email:"bpitt@mail.com", desc:'' },
    { id:2, name:"Tom Cruise", email:"tcruise@mail.com", desc:'' },
    { id:3, name:"Keifer Sutherland", email:"hsutherland@mail.com", desc:'' }
  ];

  constructor(private router:Router) { }

  ngOnInit() {
  }

  onEdit($event, id) {
    this.router.navigate(['/user',id]);
  }

  onDelete($event, id) {
    console.log("onDelete",id);
  }

}
