import { configureStore, combineReducers } from '@reduxjs/toolkit';

import { appSlice } from './app';

const rootReducer = combineReducers({
  [appSlice.name]: appSlice.reducer,
});

const store = configureStore({
  reducer: rootReducer,
  preloadedState: window.WPReact.state,
});

export default store;
