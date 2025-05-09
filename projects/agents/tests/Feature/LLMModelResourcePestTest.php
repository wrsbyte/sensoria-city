<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\LLMModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Livewire\livewire;
use App\Filament\Resources\LLMModelResource\Pages;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create(['email' => 'test@wrsbyte.com']);
});

it('can render LLM Models list', function () {
    livewire(Pages\ListLLMModels::class)
        ->assertSuccessful();
});

it('admin can view the LLM Models list', function () {
    $models = LLMModel::factory()->count(4)->create();

    livewire(Pages\ListLLMModels::class)
        ->assertCanSeeTableRecords($models)
        ->assertCountTableRecords(4);
});

it('admin can create a new LLM Model', function () {
    $model = LLMModel::factory()->make();

    livewire(Pages\CreateLLMModel::class)
        ->assertFormExists()
        ->set([
            'data.name' => $model->name,
            'data.provider' => $model->provider,
            'data.model_name' => $model->model_name,
            'data.api_key' => $model->api_key,
            'data.support_function_calling' => $model->support_function_calling,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(LLMModel::where('name', $model->name)->exists())->toBeTrue();
});

it('admin can update an existing LLM Model', function () {
    $model = LLMModel::factory()->create();

    livewire(Pages\EditLLMModel::class, ['record' => $model->id])
        ->assertFormExists()
        ->set([
            'data.name' => 'Updated ' . $model->name,
            'data.provider' => $model->provider,
            'data.model_name' => $model->model_name,
            'data.api_key' => $model->api_key,
            'data.support_function_calling' => $model->support_function_calling,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect(LLMModel::where('name', 'Updated ' . $model->name)->exists())->toBeTrue();
});

