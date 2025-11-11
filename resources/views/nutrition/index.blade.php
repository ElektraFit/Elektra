@extends('layouts.dashboard')

@section('title', 'Nutrition Tracker - ElektraFit')

@section('sidebar-nav')
    <ul>
        <x-nav-item href="{{ route('dashboard') }}" label="Dashboard">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('training-sessions.index') }}" label="Training Sessions">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="6" y="9" width="3" height="6"></rect>
                <rect x="15" y="9" width="3" height="6"></rect>
                <rect x="9" y="10.5" width="6" height="3"></rect>
                <line x1="1" y1="12" x2="6" y2="12"></line>
                <line x1="18" y1="12" x2="23" y2="12"></line>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('nutrition.index') }}" label="Nutrition" :active="true">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M16 2c0 2-2 4-2 4" />
                <path d="M19 7c-1.5-1-4-1.5-6 0-2-1.5-4.5-1-6 0-3 2-3 8 1 11 2 1.5 4 1 5 0 1 1 3 1.5 5 0 4-3 4-9 1-11z"></path>
            </svg>
        </x-nav-item>
        <x-nav-item href="{{ route('instructors') }}" label="Instructors">
            <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </x-nav-item>
    </ul>
@endsection

@section('logout-button')
    <x-logout-button />
@endsection

@section('content')
<div class="nutrition-page">
    <div class="page-header">
        <div class="header-content center-text">
            <h1 class="page-title">Nutrition Tracker</h1>
            <p class="page-subtitle">Track your meals and monitor your daily nutrition intake</p>
        </div>
    </div>

    <!-- Today's Summary -->
    <div class="nutrition-summary">
        <div class="summary-card calories-card">
            <div class="summary-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
            </div>
            <div class="summary-content">
                <div class="summary-value">{{ number_format($todayTotals['calories'], 0) }}</div>
                <div class="summary-label">Calories</div>
            </div>
        </div>
        
        <div class="summary-card protein-card">
            <div class="summary-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M2 12c.6-2.2 1.8-4 3.5-4s2.9 1.8 3.5 4c.6 2.2 1.8 4 3.5 4s2.9-1.8 3.5-4c.6-2.2 1.8-4 3.5-4s2.9 1.8 3.5 4"></path>
                </svg>
            </div>
            <div class="summary-content">
                <div class="summary-value">{{ number_format($todayTotals['protein'], 1) }}g</div>
                <div class="summary-label">Protein</div>
            </div>
        </div>
        
        <div class="summary-card carbs-card">
            <div class="summary-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </div>
            <div class="summary-content">
                <div class="summary-value">{{ number_format($todayTotals['carbs'], 1) }}g</div>
                <div class="summary-label">Carbs</div>
            </div>
        </div>
        
        <div class="summary-card fat-card">
            <div class="summary-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
                </svg>
            </div>
            <div class="summary-content">
                <div class="summary-value">{{ number_format($todayTotals['fat'], 1) }}g</div>
                <div class="summary-label">Fat</div>
            </div>
        </div>
    </div>

    <!-- Food Search -->
    <div class="search-section">
        <h2 class="section-title">Log a Meal</h2>
        <div class="search-box">
            <input type="text" id="foodSearch" placeholder="Search for food... (e.g., ugali and omena, rice and beans)" class="food-input">
            <button onclick="searchFood()" class="btn-search">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                Search
            </button>
        </div>
        
        <div id="searchResults" class="search-results"></div>
    </div>

    <!-- Today's Meals -->
    <div class="meals-section">
        <h2 class="section-title">Today's Meals</h2>
        @if($todayMeals->count() > 0)
            <div class="meals-list">
                @foreach($todayMeals as $meal)
                    <div class="meal-card">
                        <div class="meal-type-badge badge-{{ $meal->meal_type }}">
                            {{ ucfirst($meal->meal_type) }}
                        </div>
                        <div class="meal-info">
                            <h3 class="meal-name">{{ $meal->meal_name }}</h3>
                            <div class="meal-nutrition">
                                <span class="nutrition-item">{{ number_format($meal->calories, 0) }} cal</span>
                                <span class="nutrition-divider">•</span>
                                <span class="nutrition-item">{{ number_format($meal->protein, 1) }}g protein</span>
                                <span class="nutrition-divider">•</span>
                                <span class="nutrition-item">{{ number_format($meal->carbohydrates, 1) }}g carbs</span>
                                <span class="nutrition-divider">•</span>
                                <span class="nutrition-item">{{ number_format($meal->fat, 1) }}g fat</span>
                            </div>
                            <div class="meal-meta">
                                {{ $meal->serving_size }}{{ $meal->serving_unit }} • {{ $meal->created_at->format('h:i A') }}
                            </div>
                        </div>
                        <button onclick="deleteMeal({{ $meal->id }})" class="btn-delete-meal">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>No meals logged today. Start by searching for food above!</p>
            </div>
        @endif
    </div>
</div>

<!-- Add Meal Modal -->
<div id="addMealModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Meal</h2>
            <button onclick="closeModal()" class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <form id="addMealForm">
                @csrf
                <input type="hidden" id="mealName" name="meal_name">
                <input type="hidden" id="calories" name="calories">
                <input type="hidden" id="protein" name="protein">
                <input type="hidden" id="carbohydrates" name="carbohydrates">
                <input type="hidden" id="fat" name="fat">
                <input type="hidden" id="fiber" name="fiber">
                <input type="hidden" id="sugar" name="sugar">
                <input type="hidden" id="sodium" name="sodium">
                <input type="hidden" id="servingSize" name="serving_size">
                <input type="hidden" id="servingUnit" name="serving_unit">
                
                <div id="nutritionPreview" class="nutrition-preview"></div>
                
                <div class="form-group">
                    <label for="mealDate">Date</label>
                    <input type="date" id="mealDate" name="meal_date" value="{{ date('Y-m-d') }}" required class="form-input">
                </div>
                
                <div class="form-group">
                    <label for="mealType">Meal Type</label>
                    <select id="mealType" name="meal_type" required class="form-select">
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="snack">Snack</option>
                    </select>
                </div>
                
                <button type="submit" class="btn-add-meal">Add to Log</button>
            </form>
        </div>
    </div>
</div>

<style>
    .nutrition-page {
        padding: 2rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .center-text {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.7);
        text-align: center;
    }

    .nutrition-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .summary-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .summary-card:hover {
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-4px);
    }

    .summary-icon {
        font-size: 2.5rem;
    }

    .summary-value {
        font-size: 2rem;
        font-weight: 700;
        color: #00bfff;
    }

    .summary-label {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.6);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 1.5rem;
    }

    .search-section {
        margin-bottom: 3rem;
    }

    .search-box {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .food-input {
        flex: 1;
        padding: 1rem 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1.5px solid rgba(0, 191, 255, 0.3);
        border-radius: 12px;
        color: white;
        font-size: 1rem;
    }

    .food-input:focus {
        outline: none;
        border-color: rgba(0, 191, 255, 0.6);
        background: rgba(255, 255, 255, 0.08);
    }

    .btn-search {
        padding: 1rem 2rem;
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.2), rgba(0, 128, 255, 0.2));
        color: #00bfff;
        border: 1.5px solid rgba(0, 191, 255, 0.4);
        border-radius: 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-search:hover {
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.3), rgba(0, 128, 255, 0.3));
        transform: translateY(-2px);
    }

    .search-results {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1rem;
    }

    .result-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .result-card:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(0, 191, 255, 0.3);
        transform: translateY(-2px);
    }

    .result-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.75rem;
    }

    .result-nutrition {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .meals-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .meal-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .meal-card:hover {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(0, 191, 255, 0.2);
    }

    .meal-type-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .badge-breakfast { background: rgba(255, 193, 7, 0.2); color: #ffc107; }
    .badge-lunch { background: rgba(76, 175, 80, 0.2); color: #4caf50; }
    .badge-dinner { background: rgba(156, 39, 176, 0.2); color: #9c27b0; }
    .badge-snack { background: rgba(0, 191, 255, 0.2); color: #00bfff; }

    .meal-info {
        flex: 1;
    }

    .meal-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .meal-nutrition {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 0.5rem;
    }

    .nutrition-divider {
        color: rgba(255, 255, 255, 0.3);
    }

    .meal-meta {
        font-size: 0.8125rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .btn-delete-meal {
        padding: 0.5rem;
        background: rgba(255, 59, 48, 0.1);
        border: 1px solid rgba(255, 59, 48, 0.3);
        border-radius: 8px;
        color: #ff3b30;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-delete-meal:hover {
        background: rgba(255, 59, 48, 0.2);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: rgba(255, 255, 255, 0.5);
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 10000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: rgba(10, 14, 39, 0.95);
        border: 1px solid rgba(0, 191, 255, 0.3);
        border-radius: 20px;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .modal-header h2 {
        font-size: 1.5rem;
        color: #00bfff;
        margin: 0;
    }

    .modal-close {
        font-size: 2rem;
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        line-height: 1;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .nutrition-preview {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-input, .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        color: white;
        font-size: 1rem;
    }

    .form-select option {
        background: #1a1f3a;
        color: white;
        padding: 0.5rem;
    }

    .form-input:focus, .form-select:focus {
        outline: none;
        border-color: rgba(0, 191, 255, 0.5);
    }

    .btn-add-meal {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.2), rgba(0, 128, 255, 0.2));
        color: #00bfff;
        border: 1.5px solid rgba(0, 191, 255, 0.4);
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-add-meal:hover {
        background: linear-gradient(135deg, rgba(0, 191, 255, 0.3), rgba(0, 128, 255, 0.3));
        transform: translateY(-2px);
    }
</style>

<script>
    let currentFoodData = null;

    function searchFood() {
        const query = document.getElementById('foodSearch').value.trim();
        if (!query) {
            alert('Please enter a food name');
            return;
        }

        const resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = '<p style="color: rgba(255,255,255,0.6); text-align: center; padding: 2rem;">Searching...</p>';

        console.log('Searching for:', query);

        fetch('{{ route('nutrition.search') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ query: query })
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('API Response:', data);
            
            if (data.success && data.items && data.items.length > 0) {
                resultsDiv.innerHTML = data.items.map(item => `
                    <div class="result-card" onclick='selectFood(${JSON.stringify(item)})'>
                        <div class="result-name">${item.name}</div>
                        <div class="result-nutrition">
                            <span>${Math.round(item.calories)} cal</span>
                            <span>•</span>
                            <span>${item.protein_g}g protein</span>
                            <span>•</span>
                            <span>${item.carbohydrates_total_g}g carbs</span>
                            <span>•</span>
                            <span>${item.fat_total_g}g fat</span>
                        </div>
                    </div>
                `).join('');
            } else {
                const errorMsg = data.message || 'No results found. Try different keywords.';
                resultsDiv.innerHTML = `<p style="color: rgba(255,255,255,0.6); text-align: center; padding: 2rem;">${errorMsg}</p>`;
                if (data.details) {
                    console.error('API Error Details:', data.details);
                }
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            resultsDiv.innerHTML = '<p style="color: #ff3b30; text-align: center; padding: 2rem;">Error searching food. Check console for details.</p>';
        });
    }

    function selectFood(food) {
        currentFoodData = food;
        
        // Fill form
        document.getElementById('mealName').value = food.name;
        document.getElementById('calories').value = food.calories;
        document.getElementById('protein').value = food.protein_g || 0;
        document.getElementById('carbohydrates').value = food.carbohydrates_total_g || 0;
        document.getElementById('fat').value = food.fat_total_g || 0;
        document.getElementById('fiber').value = food.fiber_g || 0;
        document.getElementById('sugar').value = food.sugar_g || 0;
        document.getElementById('sodium').value = food.sodium_mg || 0;
        document.getElementById('servingSize').value = food.serving_size_g || 100;
        document.getElementById('servingUnit').value = 'g';
        
        // Show nutrition preview
        document.getElementById('nutritionPreview').innerHTML = `
            <h3 style="color: #00bfff; margin-bottom: 1rem;">${food.name}</h3>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;">
                <div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: #00bfff;">${Math.round(food.calories)}</div>
                    <div style="font-size: 0.875rem; color: rgba(255,255,255,0.6);">Calories</div>
                </div>
                <div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: #00bfff;">${food.protein_g}g</div>
                    <div style="font-size: 0.875rem; color: rgba(255,255,255,0.6);">Protein</div>
                </div>
                <div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: #00bfff;">${food.carbohydrates_total_g}g</div>
                    <div style="font-size: 0.875rem; color: rgba(255,255,255,0.6);">Carbs</div>
                </div>
                <div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: #00bfff;">${food.fat_total_g}g</div>
                    <div style="font-size: 0.875rem; color: rgba(255,255,255,0.6);">Fat</div>
                </div>
            </div>
        `;
        
        // Show modal
        document.getElementById('addMealModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('addMealModal').classList.remove('active');
    }

    document.getElementById('addMealForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());
        
        fetch('{{ route('nutrition.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error adding meal');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding meal');
        });
    });

    function deleteMeal(mealId) {
        if (!confirm('Delete this meal?')) return;
        
        fetch(`/nutrition/meals/${mealId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    // Allow Enter key to search
    document.getElementById('foodSearch').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchFood();
        }
    });
</script>
@endsection
