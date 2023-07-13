import Request from "./Request";

class User extends Request {
    constructor() {
        super();
    }

    create(fd, token) {
        const url = `${this.HOST}/user/create`;
        const options = { body: fd, headers: { Authorization: 'Bearer ' + token, }, };

        return this.send(url, "POST", options);
    }
}

export default User;