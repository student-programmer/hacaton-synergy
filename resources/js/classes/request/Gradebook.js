import Request from "./Request";

class Gradebook extends Request {
	constructor() {
		super();
	}

    create(fd, token) {
        const url = `${this.HOST}/gradebook/create`;
        const options = {
            body: fd,
            headers: { Authorization: `Bearer ${token}` },
        };

        return this.send(url, "POST", options);
    }
    change(fd, token, id) {
        const url = `${this.HOST}/gradebook/change/${id}`;
        const options = {
            body: fd,
            headers: { Authorization: `Bearer ${token}` },
        };
        return this.send(url, "POST", options);
    }

    delete(token, id) {
        const url = `${this.HOST}/gradebook/delete/${id}`;
        const options = {
            headers: { Authorization: `Bearer ${token}` },
        };
        return this.send(url, "DELETE", options);
    }


}

export default Gradebook;
