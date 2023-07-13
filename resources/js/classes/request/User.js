import Request from "./Request";

class User extends Request {
    constructor() {
        super();
    }

    create(fd, token) {

        const url = `${this.HOST}/user/create`;

        return this.send(url, "POST", { body: fd, headers:{Authorization:'Bearer ' + token}});
    }

    
}

export default User;