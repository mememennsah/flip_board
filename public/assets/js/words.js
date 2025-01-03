document.addEventListener("DOMContentLoaded", function () {
    function Word(data) {
        this.id = data.id;
        this.english_word = ko.observable(data.english_word);
        this.japanese_translation = ko.observable(data.japanese_translation);
        this.status = ko.observable(data.status);

        this.updateStatus = () => {
            const payload = {
                id: this.id,
                status: this.status()
            };

            fetch("/words/update_status", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify(payload)
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert("ステータスの更新に失敗しました");
                    }
                })
                .catch(error => {
                    console.error("エラー:", error);
                });
        };
    }

    function WordsViewModel() {
        const self = this;
        self.words = ko.observableArray([]);

        fetch("/words/get_words")
            .then(response => response.json())
            .then(data => {
                const mappedWords = data.words.map(word => new Word(word));
                self.words(mappedWords);
            })
            .catch(error => {
                console.error("エラー:", error);
            });
    }

    ko.applyBindings(new WordsViewModel());
});
