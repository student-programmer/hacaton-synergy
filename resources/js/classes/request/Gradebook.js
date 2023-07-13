import Request from "./Request";

class Gradebook extends Request {
	constructor() {
		super();
	}

<<<<<<< HEAD
    create(fd, token) {
        const url = `${this.HOST}/gradebook/create`;
        const options = {
            body: fd,
            headers: { Authorization: `Bearer ${token}` },
        };

        return this.send(url, "POST", options);
    }
    change(fd, token) {
        const url = `${this.HOST}/gradebook/change`;
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
=======
	create(fd, token) {
		const url = `${this.HOST}/gradebook/create`;
		const options = { body: fd, headers: { Authorization: `Bearer ${token}`, }, };

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
>>>>>>> 300b0362bee883843d5690be665a0773dc70e45b
}

export default Gradebook;
