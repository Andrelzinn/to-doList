class TaskManager {
    constructor() {
        this.toDoInput = document.querySelector('.todo-input');
        this.toDoBtn = document.querySelector('.todo-btn');
        this.toDoList = document.querySelector('.todo-list');
        this.linkList1 = document.querySelector('todo-link1');
        this.linkList2 = document.querySelector('todo-link2');
        this.linkList3 = document.querySelector('todo-link3');
        this.themeManager = new ThemeManager();

        this.init();
    }

    init() {
        this.toDoBtn.addEventListener('click', (e) => this.addToDo(e));
        this.toDoList.addEventListener('click', (e) => this.deleteCheck(e));
        document.addEventListener("DOMContentLoaded", () => {
            this.getTodos();
            this.themeManager.applySavedTheme();
        });
    }

    addToDo(event) {
        event.preventDefault();
        if (this.toDoInput.value === '') {
            alert("You must write something!");
            return;
        }

        const toDoDiv = this.createToDoElement(this.toDoInput.value);
        this.toDoList.appendChild(toDoDiv);
        this.saveLocal(this.toDoInput.value);
        this.toDoInput.value = '';
    }

    deleteCheck(event) {
        const item = event.target;
        if (item.classList.contains('delete-btn')) {
            const todo = item.parentElement;
            todo.classList.add("fall");
            todo.addEventListener('transitionend', () => {
                this.removeLocalTodos(todo);
                todo.remove();
            });
        } else if (item.classList.contains('check-btn')) {
            item.parentElement.classList.toggle("completed");
        }
    }

    createToDoElement(todoText) {
        const toDoDiv = document.createElement("div");
        toDoDiv.classList.add('todo', `${this.themeManager.savedTheme}-todo`);

        const newToDo = document.createElement('li');
        newToDo.innerText = todoText;
        newToDo.classList.add('todo-item');
        toDoDiv.appendChild(newToDo);

        const checked = document.createElement('button');
        checked.innerHTML = '<i class="fas fa-check"></i>';
        checked.classList.add('check-btn', `${this.themeManager.savedTheme}-button`);
        toDoDiv.appendChild(checked);

        const deleted = document.createElement('button');
        deleted.innerHTML = '<i class="fas fa-trash"></i>';
        deleted.classList.add('delete-btn', `${this.themeManager.savedTheme}-button`);
        toDoDiv.appendChild(deleted);

        return toDoDiv;
    }

    saveLocal(todo) {
        let todos = this.getLocalTodos();
        todos.push(todo);
        localStorage.setItem('todos', JSON.stringify(todos));
    }

    getLocalTodos() {
        return localStorage.getItem('todos') ? JSON.parse(localStorage.getItem('todos')) : [];
    }

    getTodos() {
        let todos = this.getLocalTodos();
        todos.forEach(todo => {
            const toDoDiv = this.createToDoElement(todo);
            this.toDoList.appendChild(toDoDiv);
        });
    }

    removeLocalTodos(todo) {
        let todos = this.getLocalTodos();
        const todoIndex = todos.indexOf(todo.children[0].innerText);
        todos.splice(todoIndex, 1);
        localStorage.setItem('todos', JSON.stringify(todos));
    }
}

class ThemeManager {
    constructor() {
        this.standardTheme = document.querySelector('.standard-theme');
        this.lightTheme = document.querySelector('.light-theme');
        this.savedTheme = localStorage.getItem('savedTheme') || 'standard';

        this.init();
    }

    init() {
        this.standardTheme.addEventListener('click', () => this.changeTheme('standard'));
        this.lightTheme.addEventListener('click', () => this.changeTheme('light'));
    }

    applySavedTheme() {
        this.changeTheme(this.savedTheme);
    }

    changeTheme(theme) {
        localStorage.setItem('savedTheme', theme);
        this.savedTheme = theme;

        document.body.className = theme;
        const title = document.getElementById('title');
        theme === 'darker' ? title.classList.add('darker-title') : title.classList.remove('darker-title');

        document.querySelector('input').className = `${theme}-input`;

        document.querySelectorAll('.todo').forEach(todo => {
            todo.className = `todo ${theme}-todo${todo.classList.contains('completed') ? ' completed' : ''}`;
        });

        document.querySelectorAll('#todo-link1, #todo-link2, #todo-link3').forEach(item =>{
            item.className = `${item.classList[0]} ${theme}-link`;
        })

        document.querySelectorAll('.check-btn, .delete-btn, .todo-btn').forEach(button => {
            button.className = `${button.classList[0]} ${theme}-button`;
        });
    }
}

const taskManager = new TaskManager();