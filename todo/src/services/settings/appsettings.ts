import {Injectable} from "@angular/core";

@Injectable()
export class AppSettings {
    public api:any = "http://localhost/todo-api/";

    constructor() {return this.api;}
}
