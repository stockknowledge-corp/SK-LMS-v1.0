AFrame.registerComponent("gesture-detector", {
    schema:{
        element: {default: ""}
    },

    init: function()
    {
        this.targetElement = this.data.element && document.querySelector(this.data.element);

        if(!this.targetElement)
        {
            this.targetElement = this.el;
        }
        
        this.internalState = {
            previousState: null
        }

        this.emitGestureEvent = this.emitGestureEvent.bind(this);
        this.targetElement.addEventListener("touchstart", this.emitGestureEvent);
        this.targetElement.addEventListener("touchend", this.emitGestureEvent);
        this.targetElement.addEventListener("touchmove", this.emitGestureEvent);
    },

    remove: function()
    {
        this.targetElement.addEventListener("touchstart", this.emitGestureEvent);
        this.targetElement.addEventListener("touchend", this.emitGestureEvent);
        this.targetElement.addEventListener("touchmove", this.emitGestureEvent);
    },

    emitGestureEvent(event)
    {
        const currentState = this.getTouchState(event);

        const previousState = this.internalState.previousState;

        const gestureContinues = previousState && currentState && currentState.touchCount == previousState.touchCount;

        const gestureEnded = previousState && !gestureContinues;

        const gestureStarted = currentState && !gestureContinues;

        if(gestureEnded)
        {
            const eventName = this.getEventPrefix(previousState.touchCount) + "fingerend";

            this.el.emit(eventName, previousState);

            this.internalState.previousState = null;
        }

        if(gestureStarted)
        {
            currentState.startTime = performance.now();

            currentState.startPosition = currentState.position;

            currentState.startSpread = currentState.spread;

            const eventName = this.getEventPrefix(currentState.touchCount) + "fingerstart";

            this.el.emit(eventName, currentState);

            this.internalState.previousState = currentState;
        }

        if(gestureContinues)
        {
            const eventDetail = 
            {
                positionChange:
                {
                    x: currentState.position.x - previousState.position.x,

                    y: currentState.position.y - previousState.position.y,
                }
            };
        }

        if(currentState.spread)
        {
            eventDetail.spreadChange = currentState.spread - previousState.spread;
        }

        // Update State with New Data
        Object.assign(previousState, currentState);

        //Add State Data to event Detail
        Object.assign(eventDetail, previousState);

        const eventName = this.getEventPrefix(currentState.touchCount) + "fingermove";
        
        this.el.emit(eventName, eventDetail);
    },

    getTouchState: function (event)
    {
        if(event.touches.length === 0)
        {
            return null;
        }

        // Convert event.touches to an array so we can use reduce
        const touchList = [];

        for(let i = 0;i < event.touches.length; i++)
        {
            touchList.push(event.touches[i]);
        }

        const touchState = {
            touchCount: touchList.length
        };


        //Calculate center of all current touches

        const centerPositionX = touchList.reduce((sum, touch) => sum + touch.clientX, 0 / touchList.length);

        const centerPositionY = touchList.reduce((sum, touch) => sum + touch.clientY,0 / touchList.length);

        touchState.positonRaw = {x: centerPositionX, y: centerPositionY};

        
        // Calculate average spread of touches from the center point

        if (touchList.length >= 2) {
            const spread =
            touchList.reduce((sum, touch) => {
                return (
                sum +
                Math.sqrt(
                    Math.pow(centerPositionRawX - touch.clientX, 2) +
                    Math.pow(centerPositionRawY - touch.clientY, 2)
                )
                );
            }, 0) / touchList.length;
    
            touchState.spread = spread * screenScale;
        }
    
        return touchState;
        },
    
        getEventPrefix(touchCount) {
        const numberNames = ["one", "two", "three", "many"];
    
        return numberNames[Math.min(touchCount, 4) - 1];
    }
});