import Request from "./Request";

class Auth extends Request {
    constructor() {
        super();
    }

    login(fd) {
        const url = `${this.HOST}/auth/login`;

        return this.send(url, "POST", { body: fd, });
    }
}

export default Auth;