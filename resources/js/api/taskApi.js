import axios from "axios";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;

export async function fetchTasks(status, page) {
    const response = await axios.get(`${API_BASE_URL}/get-tasks`, {
        params: {
            status: status,
        },
    });

    return response.data;
}

export async function saveTask(title, description, shouldReturnNewTask) {
    const response = await axios.get(`${API_BASE_URL}/save-task`, {
        params: {
            title: title,
            description: description,
            shouldReturnNewTask: shouldReturnNewTask
        },
    });

    return response.data;
}

export async function deleteTask(id) {
    const response = await axios.get(`${API_BASE_URL}/delete`, {
        params: {
            id: id,
        },
    });

    return response.data;
}

export async function changeStatus(id) {
    const response = await axios.get(`${API_BASE_URL}/change-status`, {
        params: {
            id: id,
        },
    });

    return response.data;
}