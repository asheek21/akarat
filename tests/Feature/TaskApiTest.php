<?php

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = \App\Models\User::factory()->create();

    Sanctum::actingAs($this->user, ['*']);
});

it('can create a task', function () {
    $payload = [
        'title' => 'Test Task',
        'status' => TaskStatusEnum::PENDING->value,
        'description' => 'Some description'
    ];

    $response = $this->actingAs($this->user, 'api')->postJson('/api/tasks', $payload);

    $response->assertStatus(201)
             ->assertJson([
                 'success' => true,
                 'message' => 'Task created successfully.',
                 'data' => ['title' => 'Test Task']
             ]);

    $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
});

it('can delete a task', function () {
    $task = Task::factory()->create();

    $response = $this->actingAs($this->user, 'api')->deleteJson("/api/tasks/{$task->id}");

    $response->assertStatus(200)
             ->assertJson([
                 'success' => true,
                 'message' => 'Task deleted successfully.',
                 'data' => null
             ]);

    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

it('can update a task', function () {
    $task = Task::factory()->create();

    $payload = [
        'title' => 'Updated Title',
        'status' => TaskStatusEnum::COMPLETED->value,
    ];

    $response = $this->actingAs($this->user, 'api')->putJson("/api/tasks/{$task->id}", $payload);

    $response->assertStatus(200)
             ->assertJson([
                 'success' => true,
                 'message' => 'Task updated successfully.',
                 'data' => ['title' => 'Updated Title']
             ]);

    $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Updated Title']);
});


it('can show a single task', function () {
    $task = Task::factory()->create();

    $response = $this->actingAs($this->user, 'api')->getJson("/api/tasks/{$task->id}");

    $response->assertStatus(200)
             ->assertJson([
                 'success' => true,
                 'data' => ['id' => $task->id]
             ]);
});